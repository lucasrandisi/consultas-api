<?php

namespace App\Http\Controllers;

use App\Models\HorarioConsulta;

class HorariosConsultaController extends Controller
{
	public function index() {
		return HorarioConsulta::all();
	}
}
