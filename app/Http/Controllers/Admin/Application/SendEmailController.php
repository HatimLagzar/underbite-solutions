<?php

namespace App\Http\Controllers\Admin\Application;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Application\SendEmailRequest;
use App\Mail\CustomMessageMail;
use App\Models\Patient;
use App\Services\Core\Patient\PatientService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendEmailController extends Controller
{
    private PatientService $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    public function __invoke(SendEmailRequest $request): RedirectResponse
    {
        try {
            $emails = [];
            foreach ($request->get('ids') as $id) {
                $patient = $this->patientService->findById($id);
                if (!$patient instanceof Patient) {
                    return redirect()
                        ->back()
                        ->with('error', 'Patient not found!');
                }

                $emails[] = $patient->getEmail();
            }

            $message = $request->get('message');

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
