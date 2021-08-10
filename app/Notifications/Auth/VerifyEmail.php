<?php

namespace App\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail as BaseNotification;

class VerifyEmail extends BaseNotification
{
    use Queueable;

    public static $createUrlCallback = [self::class, 'createFrontUrl'];

    public static function createFrontUrl($notifiable)
    {
        $params = [
            'id' => $id = $notifiable->getKey(),
            'hash' => $hash = sha1($notifiable->getEmailForVerification()),
        ];
        $apiUrl = URL::temporarySignedRoute(
            'api.verify.email',
            now()->addMinutes(config('auth.verification.expire', 60)),
            $params
        );

        return str_replace(
            route('api.verify.email', $params),
            route('spa', ['any' => 'admin/verify-email/' . $id . '/' . $hash]),
            $apiUrl
        );
    }
}
