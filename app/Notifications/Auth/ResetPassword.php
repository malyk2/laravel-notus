<?php

namespace App\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as BaseNotification;

class ResetPassword extends BaseNotification
{
    use Queueable;

    public static $createUrlCallback = [self::class, 'createFrontUrl'];

    public static function createFrontUrl($notifiable, $token)
    {
        $query = [
            'email' => $notifiable->getEmailForPasswordReset(),
            'token' => $token,
        ];

        // return url('admin/reset-password') . '?' . http_build_query($query);
        return route('spa', array_merge($query, ['any' => 'admin/reset-password']));
    }
}
