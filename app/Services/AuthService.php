<?php

namespace App\Services;

use App\Exceptions\UnauthorizedException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
	public static function login(string $email, string $password) {
		$user = User::where('email', $email)->first();

		if (!$user || !Hash::check($password, $user->password)) {
			throw new UnauthorizedException('Email y/o contraseña incorrectos');
		}

		return $user;
	}
}