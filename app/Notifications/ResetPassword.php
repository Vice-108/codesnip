<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as BaseResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends BaseResetPassword
{
    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $faviconPath = public_path('favicon.ico');
        $faviconType = mime_content_type($faviconPath);
        $faviconData = file_get_contents($faviconPath);
        $faviconBase64 = base64_encode($faviconData);

        return (new MailMessage)
            ->subject('Reset Your Password - CodeSnip')
            ->view('emails.password-reset', [
                'resetUrl' => url(route('password.reset', [
                    'token' => $this->token,
                    'email' => $notifiable->getEmailForPasswordReset(),
                ], false)),
                'user' => $notifiable,
                'appName' => config('app.name'),
                'faviconBase64' => $faviconBase64,
                'faviconType' => $faviconType
            ]);
    }
}
