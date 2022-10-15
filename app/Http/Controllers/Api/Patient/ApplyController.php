<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Patient\ApplyRequest;
use App\Services\Domain\Patient\ApplyService;
use App\Services\Domain\Patient\Exceptions\PatientAlreadyExistsException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ApplyController extends BaseController
{
    private ApplyService $applyService;

    public function __construct(ApplyService $applyService)
    {
        $this->applyService = $applyService;
    }

    public function __invoke(ApplyRequest $request): JsonResponse
    {
        try {
            $patient = $this->applyService->apply(
                $request->get('first_name'),
                $request->get('last_name'),
                $request->get('email'),
                $request->get('gender'),
                $request->get('age'),
                $request->get('height'),
                $request->get('weight'),
                $request->get('phone_number'),
                $request->get('phone_code'),
                $request->get('social_network_note'),
                $request->get('country_id'),
                $request->file('front_view'),
                $request->file('left_view'),
                $request->file('right_view'),
            );

            return $this->withSuccess([
                'message' => __(sprintf('Hello %s, your request has been saved, we\'ll get back to you soon. Thank you!',
                    $patient->getFirstName())),
            ]);
        } catch (PatientAlreadyExistsException $e) {
            return $this->withError(__('Patient case already exists, and under review, thank you!'),
                Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Throwable $e) {
            Log::error('failed to apply', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError(__('Error occurred, please retry later!'));
        }
    }
}
