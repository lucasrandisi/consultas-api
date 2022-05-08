<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHorarioConsultaRequest;
use App\Http\Requests\DeleteHorarioConsultaRequest;
use App\Models\HorarioConsulta;
use App\Models\Materia;
use App\Models\Parametro;
use Carbon\Carbon;

class HorariosConsultaController extends Controller
{
	public function index() {
		return HorarioConsulta::all();
	}

	public function create(CreateHorarioConsultaRequest $request) {
		$day = $request->input('day');

		$inicioCicloLectivo = new Carbon(Parametro::find(Parametro::INICIO_CICLO_LECTIVO)->value);
		$finCicloLectivo = new Carbon(Parametro::find(Parametro::FIN_CICLO_LECTIVO)->value);

		$date = $inicioCicloLectivo->is($day) ?
			$inicioCicloLectivo->copy() :
			$inicioCicloLectivo->copy()->next($day);


		while ($date->lessThanOrEqualTo($finCicloLectivo)) {
			$date->hour = $request->input('hour');

			HorarioConsulta::create([
				'date_hour' => $date,
				'user_id' => $request->input('user_id'),
				'materia_id' => $request->input('materia_id'),
			]);

			$date->next($day);
		}
	}

	public function delete(DeleteHorarioConsultaRequest $request) {
		$day = $request->input('day');
		$hour = $request->input('hour');

		$horariosConsulta = HorarioConsulta::where([
			'user_id' => $request->input('user_id'),
			'materia_id' => $request->input('materia_id')
		])->get();

		$horariosConsultaIdToDelete = [];

		foreach ($horariosConsulta as $horarioConsulta) {
			$horarioConsultaDateHour = new Carbon($horarioConsulta->date_hour);

			if ( $horarioConsultaDateHour->is($day) && $horarioConsultaDateHour->hour === $hour) {
				$horariosConsultaIdToDelete[] = $horarioConsulta->id;
			}
		}

		HorarioConsulta::whereIn('id', $horariosConsultaIdToDelete)->delete();
	}
}
