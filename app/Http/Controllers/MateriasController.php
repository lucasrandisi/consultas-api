<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMateriaRequest;
use App\Models\Materia;
use Illuminate\Http\Request;

class MateriasController extends Controller
{
	public function index(Request $request) {
		$filters = $request->input('filters', []);

		$query = Materia::query();

		foreach ($filters as $key => $value) {
			if (in_array($key, ['name'])) {
				$query->where($key, 'LIKE', "%{$value}%");
			}
		}

		return $query->get();
	}

	public function create(CreateMateriaRequest $request) {
		return Materia::create($request->validated());
	}
}
