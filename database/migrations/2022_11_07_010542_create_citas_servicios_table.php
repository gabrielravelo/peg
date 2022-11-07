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
        Schema::create('citas_servicios', function (Blueprint $table) {
            $table->id('cita_servicio_id');
            $table->foreignId('cita_id')->references('cita_id')->on('citas');
            $table->foreignId('servicio_id')->references('servicio_id')->on('servicios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citas_servicios');
    }
};
