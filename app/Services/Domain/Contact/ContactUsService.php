<?php

namespace App\Services\Domain\Contact;

use App\Mail\Contact\ContactUsMail;
use Illuminate\Support\Facades\Mail;

class ContactUsService
{
    public function send(string $firstName, string $lastName, string $email, string $subject, string $message): bool
    {
        $subject = $firstName . ' || ' . $email . ' || ' . $subject;

        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->send(new ContactUsMail($firstName, $lastName, $email, $subject, $message));

        return true;
    }
}