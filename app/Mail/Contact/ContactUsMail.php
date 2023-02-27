<?php

namespace App\Mail\Contact;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $firstName;
    public string $lastName;
    public string $email;
    public $subject;
    public string $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $firstName, string $lastName, string $email, string $subject, string $message)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->markdown('mails.contact-us');
    }
}
