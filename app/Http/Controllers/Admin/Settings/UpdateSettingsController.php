<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UpdateRequest;
use App\Models\User;
use App\Services\Core\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Testing\Fluent\Concerns\Has;
use Throwable;

class UpdateSettingsController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        try {
            /** @var User $user */
            $user = auth()->user();

            if (!Hash::check($request->get('current_password'), $user->getPassword())) {
                return redirect()
                    ->back()
                    ->with('error', 'Incorrect password!');
            }

            $this->userService->update($user, [
                User::NAME_COLUMN     => $request->get('name'),
                User::PASSWORD_COLUMN => Hash::make($request->get('password'))
            ]);

            return redirect()
                ->back()
                ->with('success', 'Settings updated successfully.');
        } catch (Throwable $e) {
            Log::error('failed to update settings', [
                'error_message' => $e->getMessage(),
            ]);

            return redirect()
                ->route('admin.home')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}