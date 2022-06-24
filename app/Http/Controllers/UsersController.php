<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UsersService;

class UsersController extends Controller
{
	public function index() {
		return User::all();
	}

	public function create(CreateUserRequest $request) {
		$data = $request->validated();

		/** @var User $user */
		$user = UsersService::create($data);

		$user->load('rol');

		return new UserResource($user);
	}
}
