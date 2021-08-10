<?php

namespace App\Listeners\Admin;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AuthEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function handleRegistered(\App\Events\Admin\Auth\Registered $event)
    {
        if (!$event->user->hasVerifiedEmail()) {
            $event->user->sendEmailVerificationNotification();
        }
    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Admin\Auth\Registered::class,
            [AuthEventSubscriber::class, 'handleRegistered']
        );
    }
}
