<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;

class ConsultasController extends Controller
{
    public function index(Request $request) {
		return Consulta::all();
	}

	public function create() {

	}
}
