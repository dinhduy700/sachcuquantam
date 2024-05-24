<?php

namespace App\Listeners;

use App\Events\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Setting;

class SendMailFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendMail  $event
     * @return void
     */
    public function handle(SendMail $event)
    {
        $dataCart = $event->dataCart;
        $data = $event->data;
        $setting = Setting::first();
        $email = filter_var($setting->email, FILTER_VALIDATE_EMAIL) ? $setting->email : env('MAIL_FROM_ADDRESS');
        try{
            Mail::send('frontend.email.checkout-email', ['dataCart' => $dataCart, 'data' => $data], function($message) use ($data, $email) {
                $message->from($email, $email);
                $message->to($data['order_email']);
                $message->subject('Tạo Đơn Hàng Thành Công'.': '.$data['order_code'] );
            });
        } catch (\Swift_TransportException $e) {
            Log::error('progress.sentMailError');
        }
    }
}
