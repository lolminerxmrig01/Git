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

class InvoicePaid extends KavenegarBaseNotification
{
    use Queueable;

    public $invoiceـnumber;
    public $tracking_code;
    public $order_code;
    public $cost;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoiceـnumber, $tracking_code, $order_code, $cost)
    {
        $this->invoiceـnumber = $invoiceـnumber;
        $this->tracking_code = $tracking_code;
        $this->order_code = $order_code;
        $this->cost = $cost;
    }

    public function toKavenegar($notifiable)
    {
        $peyment_success_message = Setting::where('name', 'peyment_success_message')->first()->value;

        $from = ['[customer]', '[invoice_code]', '[order_code]', '[cost]', '[tracking_code]'];
        $to = [customerFullName($withNumbr = false), $this->invoiceـnumber, $this->order_code, $this->cost, $this->tracking_code];

        $peyment_success_message = $peyment_success_message ? str_replace($from, $to, $peyment_success_message) : '';

        $sender = Setting::where('name', 'sms_sender_number')->first()->value;
        $customer_name = customerFullName($withNumbr = false);
        
        $message = $peyment_success_message 
            ?? $customer_name ? $customer_name .  ' عزیز ': ''
            . "پرداخت شما موفق بود";

        return (new KavenegarMessage($message))
            ->from($sender);
    }
}
