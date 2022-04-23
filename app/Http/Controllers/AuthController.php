<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request) {
		$email = $request->input('email');
		$password = $request->input('password');

		$user = AuthService::login($email, $password);

		return response()->json([
			'access_token' => $user->createToken('Bearer')->plainTextToken,
			'user' => new UserResource($user)
		]) ;
	}

	public function me() {
		/** @var User $user */
		$user = Auth::user();

		return new UserResource($user);
	}
}
