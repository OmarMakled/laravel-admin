<?php

namespace App\Http\Controllers\Api;

use App\Bus\Commands\User\CreateUserCommand;
use App\Bus\Commands\User\UpdateUserCommand;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Validator\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signOut(Request $request)
    {
        Auth::guard()->logout();
        $request->session()->invalidate();

        return response()->json([]);
    }

    public function signUp(Request $request)
    {
        try {
            $user = CreateUserCommand::dispatchNow($request->only('name', 'email', 'password'));
            Auth::login($user, true);
            $request->session()->regenerate();
            return response()->json([], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->getMessageBag()], 422);
        }
    }

    public function signIn(Request $request)
    {
        $validator = Validator::make(
            $request->only('email', 'password'), [
                'email' => 'required|email',
                'password' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Auth::guard()
            ->attempt($request->only('email', 'password'), $request->filled('remember'));

        if (!$user) {
            return response()->json([
                'errors' => [
                    'email' => [trans('auth.failed')],
                ],
            ], 422);
        }

        $request->session()->regenerate();
        return response()->json([], 201);
    }

    public function profile(Request $request)
    {
        try {
            $user = UpdateUserCommand::dispatchNow(Auth::user(), $request->only('name', 'email', 'password'));
            return response()->json([], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->getMessageBag()], 422);
        }
    }
}
