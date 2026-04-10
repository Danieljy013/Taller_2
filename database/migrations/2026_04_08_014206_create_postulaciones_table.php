<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('postulaciones', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('apellidos')->nullable();
        $table->integer('edad')->nullable();
        $table->string('sexo')->nullable();
        $table->string('email');
        $table->string('telefono')->nullable();
        $table->string('departamento')->nullable();
        $table->string('ciudad')->nullable();
        $table->string('cargo')->nullable();
        $table->string('empresa')->nullable();
        $table->string('ciudad_empresa')->nullable();
        $table->string('experiencia')->nullable();
        $table->text('logros')->nullable();
        $table->string('idiomas')->nullable();
        $table->text('motivacion')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulaciones');
    }
};
