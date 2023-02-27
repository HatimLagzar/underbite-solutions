<?php

namespace App\Mail;

use App\Models\Patient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public ?string $message;
    public Patient $patient;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Patient $patient, ?string $message)
    {
        $this->message = $message;
        $this->patient = $patient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): CustomMessageMail
    {
        return $this->markdown('mails.custom-message');
    }
}
