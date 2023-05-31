<?php

namespace App\Listeners\EventTutorial;

use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\EventTutorial\UserSubscribed;
use App\Mail\EventTutorial\userSubscriberEmail;
use Illuminate\Support\Facades\Mail;

class EmailOwnerAboutSubscription
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserSubscribed $event): void
    {
        DB::table('newsletters')->insert([
            'email' => $event->email
        ]);

        // call email to send message
        Mail::to($event->email)->send(
            new userSubscriberEmail($event->email)
        );
    }
}
