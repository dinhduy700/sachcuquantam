<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscribeProduct extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($product, $email)
    {
        $this->product = $product;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $product = $this->product;
        $email = $this->email;
        return $this->subject('Subscribe mail từ '.env('APP_NAME').' Sản phẩm: '.$this->product->translation->product_name)->view('mail.product', compact('product', 'email'));
    }
}
