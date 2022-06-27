<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioConsulta extends Model
{
	protected $table = 'horarios_consultas';
	protected $guarded = [];
	public $timestamps = false;

	public function materia() {
		return $this->belongsTo(Materia::class, 'materia_id');
	}

	public function profesor() {
		return $this->belongsTo(User::class, 'profesor_id');
	}

	public function consultas() {
		return $this->hasMany(Consulta::class);
	}
}
