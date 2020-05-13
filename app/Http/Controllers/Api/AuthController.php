<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    public function updateProfile(Request $request)
    {
        $validator = Validator::make(
            $request->only('name', 'email', 'password'), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'sometimes|min:8',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Auth::user();
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return response()->json([], 201);

    }
}
