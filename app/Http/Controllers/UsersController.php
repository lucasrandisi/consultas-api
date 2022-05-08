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

	public function store(CreateUserRequest $request) {
		$data = $request->validated();


		$user = UsersService::create($data);

		return new UserResource($user);
	}
}
