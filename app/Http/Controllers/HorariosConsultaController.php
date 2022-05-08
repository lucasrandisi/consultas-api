<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHorarioConsultaRequest;
use App\Models\HorarioConsulta;
use App\Models\Materia;
use Carbon\Carbon;

class HorariosConsultaController extends Controller
{
	public function index() {
		return HorarioConsulta::all();
	}

	public function store(CreateHorarioConsultaRequest $request) {
		$dayOfTheWeek = $request->input('dia');

		$firstConsultaDate = new Carbon("first {$dayOfTheWeek}  of January");
		$lastConsultaDate = new Carbon("last {$dayOfTheWeek} of December");

		$date = $firstConsultaDate;

		while($date->lessThanOrEqualTo($lastConsultaDate)) {
			HorarioConsulta::create([
				'dia' => $date,
				'hora' => $request->input('hora'),
				'user_id' => $request->input('user_id'),
				'materia_id' => $request->input('materia_id'),
			]);
		}
	}
}
