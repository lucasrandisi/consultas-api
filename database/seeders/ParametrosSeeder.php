<?php

namespace Database\Seeders;

use App\Models\Parametro;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParametrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parametros')->insert([
        	[
				'id' => Parametro::INICIO_CICLO_LECTIVO,
				'name' => 'Inicio Ciclo Lectivo',
				'value' => '2022-03-14'
			],
			[
				'id' => Parametro::FIN_CICLO_LECTIVO,
				'name' => 'Fin Ciclo Lectivo',
				'value' => '2023-03-17'
			]
		]);
    }
}
