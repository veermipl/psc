<?php

namespace App\Mail\admin\user;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendUserWelcomeRegistrationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $userData;

    /**
     * Create a new message instance.
     */
    public function __construct($userData)
    {
        $this->userData = $userData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to '.$this->userData['app_name'].'',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.admin.user.send-user-welcome-registration-mail',
            with: [
                'name' => $this->userData['name'],
                'email' => $this->userData['email'],
                'password' => $this->userData['password'],
                'created_at' => now(),
                'app_name' => $this->userData['app_name'],
                'support_mail' => $this->userData['support_mail'],
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
