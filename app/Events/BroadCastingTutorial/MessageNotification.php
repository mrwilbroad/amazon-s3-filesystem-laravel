<?php

namespace App\Events\BroadCastingTutorial;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


// implements ShouldbroadCast 
class MessageNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

     public $message;
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('Notification'),
        ];


    /**
     * type of Channel 
     * public Channel - ANy user Can Subscribe at
     * private Channel Only Authenticated user
     * Pressence Channel
     * 
     * Then Go to install laravel Echo
     * npm i pusher-js laravel-echo --save
     */
    }
}
