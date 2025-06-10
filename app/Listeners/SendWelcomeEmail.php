<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SendWelcomeEmail implements ShouldQueue
{
    public function handle(NewUserRegistered $event)
    {
        $user = $event->user;
        Log::error('có gửi mail nè');
        
        // Gửi email chào mừng tới người dùng
        // Implement logic gửi email ở đây
    }
}
