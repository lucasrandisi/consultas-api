<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioConsulta extends Model
{
	protected $table = 'horarios_consultas';
	protected $guarded = [];
	public $timestamps = false;
}
