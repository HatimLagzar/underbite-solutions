<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Models\User;
use App\Services\Domain\Auth\LoginService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class LoginController extends Controller
{
    private LoginService $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function __invoke(LoginRequest $request): RedirectResponse
    {
        try {
            if (!$this->loginService->login(
                $request->get('email'),
                $request->get('password'),
            )) {
                return redirect()
                    ->route('admin.login')
                    ->with('error', 'Incorrect credentials!');
            }

            return redirect()
                ->route('admin.home')
                ->with('success', 'Logged in successfully.');
        } catch (Throwable $e) {
            Log::error('failed to login', [
                'error_message' => $e->getMessage(),
                'error_trace'   => Str::limit($e->getTraceAsString(), 1000)
            ]);

            return redirect()
                ->route('admin.login')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}
