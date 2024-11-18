<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendPassword extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $password;
    public string $name;
    public string $email;

    public function __construct($data)
    {
        $this->password = $data['password'];
        $this->name = $data['name'];
        $this->email = $data['email'];
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Send Password',
        );
    }

    public function content()
    {
        return new Content(
            view: 'mail.user.password',
        );
    }

    public function attachments()
    {
        return [];
    }
}
