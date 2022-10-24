<?php

namespace App\Http\Controllers\Admin\Application;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Application\SendEmailRequest;
use App\Mail\CustomMessageMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendEmailController extends Controller
{
    public function __invoke(SendEmailRequest $request)
    {
        try {
            $message = $request->get('message');
            $emails = $request->get('emails');

            foreach ($emails as $email) {
                Mail::to($email)
                    ->queue(new CustomMessageMail($message));
            }

            return redirect()
                    ->back()
                    ->with('success', 'Message sent to ' . join(', ', $emails) . ' successfully.');
        } catch (Throwable $e) {
            Log::error('failed to send email', [
                'error_message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}
