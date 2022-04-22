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
        Schema::create('horarios_consultas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('usuarios');
			$table->foreignId('materia_id')->constrained('materias');
			$table->date('dia');
			$table->string('hora');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horarios_consultas');
    }
};
