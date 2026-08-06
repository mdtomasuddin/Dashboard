<?php

namespace App\Notifications\Api\V1\Auth;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendOtpNotification extends Notification
{
    /**
     * Create a new notification instance.
     */
    public function __construct(
        public string $otp,
        public int $expiresInMinutes = 10
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Security Verification Code: '.$this->otp)
            ->view('emails.api.v1.auth.otp', [
                'user' => $notifiable,
                'otp' => $this->otp,
                'expiresInMinutes' => $this->expiresInMinutes,
                'appName' => config('app.name', 'Volgenteam'),
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'otp' => $this->otp,
            'expires_in_minutes' => $this->expiresInMinutes,
        ];
    }
}
