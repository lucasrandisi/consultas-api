<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateConsultaRequest;
use App\Models\Consulta;
use App\Models\User;
use Illuminate\Http\Request;

class ConsultasController extends Controller
{
    public function index(Request $request) {
    	$filters = $request->input('filters', []);
    	$orders = $request->input('orders', []);

		$query = Consulta::query();

		foreach ($filters as $key => $value) {
			if (in_array($key, ['estudiante_id', 'horario_consulta_id'])) {
				$query->where($key, '=', $value);
			}
		}

		foreach ($orders as $key => $value) {
			if (in_array($key, ['created_at'])) {
				$query->orderBy($key, $value);
			}
		}

		return $query->get();
	}

	public function create(CreateConsultaRequest $request) {
    	$email = $request->input('email');

		$user = User::where(['email' => $email])->first();

		return Consulta::create([
			'horario_consulta_id' => $request->input('horario_consulta_id'),
			'estudiante_id' => $user->id
		]);
	}
}
