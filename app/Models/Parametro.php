<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
	const INICIO_CICLO_LECTIVO = 1;
	const FIN_CICLO_LECTIVO = 2;

	protected $table = 'parametros';
	public $timestamps = false;
	protected $guarded = [];
}
