<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscribeNews extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($news, $email)
    {
        $this->news = $news;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $news = $this->news;
        $email = $this->email;
        return $this->subject('Subscribe mail từ '.env('APP_NAME').' Tin tức: '.$this->news->translation->news_title)->view('mail.news', compact('news', 'email'));
    }
}
