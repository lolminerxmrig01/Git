<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kavenegar\Laravel\Message\KavenegarMessage;
use Kavenegar\Laravel\Notification\KavenegarBaseNotification;
use Modules\Staff\Peyment\Models\PeymentRecord;
use Modules\Staff\Setting\Models\Setting;

class OrderStatusChanged extends KavenegarBaseNotification
{
    use Queueable;

    public $order_code;
    public $status;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order_code, $status)
    {
        $this->order_code = $order_code;
        $this->status = $status;
    }

    public function toKavenegar($notifiable)
    {
        $message = Setting::where('name', 'delivery_sms_text')->first()->value;
        $customer_name = customerFullName($withNumbr = false);

        $from = ['[customer]', '[order_code]', '[status]'];
        $to = [$customer_name, $this->order_code, $this->status];

        $message = $message ? str_replace($from, $to, $message) : '';

        $sender = Setting::where('name', 'sms_sender_number')->first()->value;
        
        $message = $message 
            ?? $customer_name ? $customer_name .  ' عزیز ': ''
            . "<br>" . "سفارش‌تان در وضعیت " . $this->status . ' قرار گرفت'
            . "<br>" . 'شماره سفارش: ' . $this->order_code;

        return (new KavenegarMessage($message))
            ->from($sender);
    }
}
