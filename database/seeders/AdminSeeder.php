<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$password = env('ADMIN_PASSWORD', 'password');
		$hashedPassword = Hash::make($password);

        User::create([
			'name' => env('ADMIN_NAME', 'Admin'),
			'email' => env('ADMIN_EMAIL', 'admin@frro.utn.edu.ar'),
			'password' => $hashedPassword,
			'rol_id' => Rol::ROL_ADMIN
		]);
    }
}
