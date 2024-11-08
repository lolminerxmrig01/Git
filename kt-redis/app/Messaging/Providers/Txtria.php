<?php

namespace App\Messaging\Providers;

use App\DeliveryReport;
use App\Messaging\Exceptions\MessageFailedToSendException;
use App\Messaging\ProviderMessage;
use App\Messaging\Providers\Provider;
use App\Outbound;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Txtria extends Provider
{
    public $endpoint = 'https://txtria.net/api';

    public function send($user, $password, $from, $to, $message)
    {
        $response = Http::asForm()->post($this->endpoint('sendsms'), [
            'sys_id' => $user,
            'auth_token' => $password,
            'From' => number($from),
            'To' => number($to),
            'Body' => $message,
        ]);

        $json = $response->json();

        if (array_key_exists('error', $json) && (bool) $json['error'] === true) {
            $this->throwException(number($from), number($to), $user, $password, $json['message'] ?? null);

        }

        return ProviderMessage::fromTxtria($json['tracking_id'], $from, $to, $message);
    }

    public function throwException($from, $to, $user, $password, $message, $exception = null)
    {
        Log::error('Message failed to send on the TxTRIA provider.', [
            'from' => number($from),
            'user' => $user,
            'password' => $password,
            'error' => $message,
        ]);

        throw new MessageFailedToSendException($message);
    }

    public function deliveryReportFromRequest(array $fields)
    {
        $outbound = Outbound::where('response', $fields['tracking_id'])->latest('id')->first();

        if (!$outbound) {
            return null;
        }

        $meta = Arr::only($fields, ['error', 'status', 'send_status', 'tracking_id']);
        $error = $this->parseDlrError($fields['error']);

        $deliveryReport = DeliveryReport::make([
            'status' => $fields['status'],
            'delivered_at' => Carbon::parse($fields['time']),
            'error' => $error,
            'outbound_id' => $outbound->id,
            'account_id' => $outbound->account_id,
        ]);

        return tap($deliveryReport, fn($deliveryReport) => $deliveryReport->meta = $meta);
    }

    public function parseDlrError($error)
    {
        $errors = [
            '0' => null,
            '00' => null,
            '000' => null,
            '200' => null,
            '210' => null,
            '599' => null,
            '110' => 'Undelivered',
            '120' => 'Expired',
            '130' => 'Deleted',
            '140' => 'Unknown',
            //'112' => 'spam',
            '401' => 'Rejected - 401',
            '404' => 'Invalid',
            '420' => 'Rejected - 420',
            '500' => 'Rejected - 500',
            //'505' => 'spam',
            '510' => 'Falied',
            '520' => 'Rejected - 520',
            '699' => 'Something UX Happened',
        ];

        if (array_key_exists($error, $errors)) {
            return $errors[$error];
        }

        return $error;
    }
}
