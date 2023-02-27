<?php

namespace App\Http\Controllers\Api\Contact;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Contact\ContactUsRequest;
use App\Services\Domain\Contact\ContactUsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class ContactUsController extends BaseController
{

    private ContactUsService $contactUsService;

    public function __construct(ContactUsService $contactUsService)
    {
        $this->contactUsService = $contactUsService;
    }

    public function __invoke(ContactUsRequest $request): JsonResponse
    {
        try {
            $this->contactUsService->send(
                $request->get('first_name'),
                $request->get('last_name'),
                $request->get('email'),
                $request->get('subject'),
                $request->get('message'),
            );

            return $this->withSuccess([
                'message' => __('Your message has been sent successfully.')
            ]);
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return $this->withError(__('Error occurred, please retry later!'));
        }
    }
}