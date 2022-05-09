<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
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

	public function create() {

	}
}
