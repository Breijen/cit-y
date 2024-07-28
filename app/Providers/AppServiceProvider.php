<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Please Confirm Your Email Address')
                ->greeting('Hi there!')
                ->line('You\'re only one step away from becoming a **Citizen**.')
                ->line('We just need to verify your email address to complete your registration.')
                ->line('Click the button below to verify your email address and start enjoying all the benefits of being a Citizen.')
                ->action('Verify Email Address', $url)
                ->line('If you did not create an account, no further action is required.')
                ->line('We hope you enjoy Cit-Y and all it has to offer!')
                ->salutation('Best regards,<br>The Citizen Team');
        });
    }
}
