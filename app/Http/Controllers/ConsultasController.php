<?php

namespace App\Http\Controllers;

use App\Models\Consulta;

class ConsultasController extends Controller
{
    public function index() {
		return Consulta::all();
	}
}
