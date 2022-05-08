<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultas', function($table) {
			$table->dropForeign(['materia_id']);
			$table->dropColumn('materia_id');

			$table->foreignId('horario_consulta_id')->constrained('horarios_consultas');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consultas', function($table) {
			$table->dropForeign(['horario_consulta_id']);
			$table->dropColumn('horario_consulta_id');

			$table->foreignId('materia_id')->constrained('materias');
		});
    }
};
