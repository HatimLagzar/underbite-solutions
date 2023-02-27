<?php

namespace App\Mail;

use App\Models\Notification;
use App\Models\Patient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationPatientMail extends Mailable
{
    use Queueable, SerializesModels;

    public Notification $notification;
    public Patient $patient;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        Notification $notification,
        Patient $patient
    ) {
        //
        $this->notification = $notification;
        $this->patient = $patient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): NotificationPatientMail
    {
        return $this->markdown('mails.notification-patient');
    }
}
