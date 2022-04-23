<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
	const ROL_ADMIN = 1;
	const ROL_PROFESOR = 2;
	const ROL_ALUMNO = 3;
}
