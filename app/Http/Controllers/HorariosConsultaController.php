<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHorarioConsultaRequest;
use App\Http\Requests\DeleteHorarioConsultaRequest;
use App\Models\HorarioConsulta;
use App\Models\Parametro;
use Carbon\Carbon;
use Illuminate\Http\Request;


class HorariosConsultaController extends Controller
{
	public function index(Request $request) {
		$filters = $request->input('filters', []);
		$orders = $request->input('orders', []);
		$limit = $request->input('limit', 20);


		$query = HorarioConsulta::query();
		$query->whereDate('date_hour', '>=', new Carbon());

		foreach ($filters as $key => $value) {
			if (in_array($key, ['materia_id', 'profesor_id'])) {
				$query->where($key, '=', $value);
			}
		}

		$query->orderBy('date_hour');

		foreach ($orders as $key => $value) {
			if (in_array($key, ['date_hour'])) {
				$query->orderBy($key, $value);
			}
		}

		$query->limit($limit);

		return $query->get();
	}

	public function create(CreateHorarioConsultaRequest $request) {
		$day = $request->input('day');
		$hour = $request->input('hour');

		$inicioCicloLectivo = new Carbon(Parametro::find(Parametro::INICIO_CICLO_LECTIVO)->value);
		$finCicloLectivo = new Carbon(Parametro::find(Parametro::FIN_CICLO_LECTIVO)->value);

		$date = $inicioCicloLectivo->is($day) ?
			$inicioCicloLectivo->copy() :
			$inicioCicloLectivo->copy()->next($day);

		while ($date->lessThanOrEqualTo($finCicloLectivo)) {
			$date->hour = $hour;

			HorarioConsulta::create([
				'date_hour' => $date,
				'profesor_id' => $request->input('profesor_id'),
				'materia_id' => $request->input('materia_id'),
			]);

			$date->next($day);
		}
	}

	public function delete(DeleteHorarioConsultaRequest $request) {
		$day = $request->input('day');
		$hour = $request->input('hour');

		$horariosConsulta = HorarioConsulta::where([
			'profesor_id' => $request->input('profesor_id'),
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
