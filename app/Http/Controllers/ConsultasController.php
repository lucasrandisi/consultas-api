<?php

namespace App\Http\Controllers;

use App\Exceptions\BusinessException;
use App\Exceptions\UnauthorizedException;
use App\Http\Requests\CreateConsultaRequest;
use App\Mail\NewConsulta;
use App\Models\Consulta;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ConsultasController extends Controller
{
    public function index(Request $request) {
    	/** @var User $currentUser */
		$currentUser = Auth::user();

		if ($currentUser->rol_id !== Rol::ROL_PROFESOR) {
			throw new UnauthorizedException("No presenta el rol de profesor");
		}

		$query = Consulta::query();

		$query->join(
			'horarios_consultas',
			'horarios_consultas.id',
			'=',
			'consultas.horario_consulta_id'
		);

		$query->where("horarios_consultas.profesor_id", '=', $currentUser->id);

		$query->selectRaw('
			consultas.horario_consulta_id as horario_consulta_id, 
			COUNT(consultas.id) as inscriptos
		');
		$query->groupBy('consultas.horario_consulta_id');
		$query->with('horarioConsulta.materia');

		return $query->get();
	}

	public function create(CreateConsultaRequest $request) {
    	$email = $request->input('email');

		$user = User::where(['email' => $email])->first();

		if (!$user) {
			throw new BusinessException('El email ingresado no se encuentra registrado');
		}

		$consulta = Consulta::where([
			'horario_consulta_id' => $request->input('horario_consulta_id'),
			'estudiante_id' => $user->id,
		])->first();

		if ($consulta) {
			throw new BusinessException('Ya se encuentra registrado a la consulta.');
		}

		$consulta = Consulta::create([
			'horario_consulta_id' => $request->input('horario_consulta_id'),
			'estudiante_id' => $user->id
		]);

		Mail::to($consulta->horarioConsulta->profesor->email)->send(new NewConsulta($consulta));

		return $consulta;
	}
}
