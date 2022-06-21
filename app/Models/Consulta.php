<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table = 'consultas';
    protected $guarded = [];

	public function horarioConsulta() {
		return $this->belongsTo(HorarioConsulta::class, 'horario_consulta_id');
	}
}
