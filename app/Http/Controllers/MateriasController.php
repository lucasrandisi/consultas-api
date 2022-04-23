<?php

namespace App\Http\Controllers;

use App\Models\Materia;

class MateriasController extends Controller
{
	public function index() {
		return Materia::all();
	}
}
