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
        Schema::create('accesos_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rol_id')->constrained('roles');
			$table->foreignId('acceso_id')->constrained('accesos');

			$table->unique(['rol_id', 'acceso_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesos_roles');
    }
};
