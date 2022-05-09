<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateParametroRequest;
use App\Models\Parametro;

class ParametrosController extends Controller
{
	public function index() {
		return Parametro::all();
	}

    public function create(CreateParametroRequest $request) {
		return Parametro::create($request->validated());
	}
}
