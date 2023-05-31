<?php

namespace App\Mail\EventTutorial;

use Illuminate\Mail\Mailables\Address;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class userSubscriberEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     private $email;
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    // render data when data attribute is public , otherwise use with..
    public function envelope(): Envelope
    {
        return new Envelope(
            // from: new Address('wfrancis169@gmail.com','mrwilbroad mark'),
            replyTo:[
                new Address('mrwilbroadmark@gmail.com','mrwilbroadTz')
            ],
            subject: 'mrwilbroad Payment Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'Email.Subscriber',
            with: [
                'ClientEmail' => $this->email,
                "Assignedtask"  => DB::table('tasks')->where("user_id",65)->first()
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
