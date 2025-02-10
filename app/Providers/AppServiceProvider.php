<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
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
        Carbon::setLocale(config('app.locale'));

        ResetPassword::toMailUsing(function($notifiable, $token) {
            return (new MailMessage())
                ->subject('Restablecimiento de Contraseña')
                ->greeting('¡Hola ' . $notifiable->name . '!')
                ->line('Recibimos una solicitud para restablecer tu contraseña.')
                ->action('Restablecer Contraseña', url(route('password.reset', $token . '?email=' . $notifiable->email , false)))
                ->line('Si no solicitaste este cambio, puedes ignorar este mensaje.');
        });
    }
}
