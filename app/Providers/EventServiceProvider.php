<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use app\Events\SendMail;
use app\Listeners\SendMailFired;
use app\Events\NewUserRegistered;
use app\Listeners\SendWelcomeEmail;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\SendMail' => [
            'App\Listeners\SendMailFired',
        ],
        'App\Events\NewUserRegistered' => [
            'App\Listeners\SendWelcomeEmail',
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(
            SendMail::class,
            [SendMailFired::class, 'handle']
        );
        Event::listen(
            NewUserRegistered::class,
            [SendWelcomeEmail::class, 'handle']
        );
    }
}
