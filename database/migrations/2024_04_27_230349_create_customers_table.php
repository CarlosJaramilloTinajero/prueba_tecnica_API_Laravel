<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->string('dni', 45)->comment('Documento de Identidad'); // PK
            $table->unsignedBigInteger('id_reg'); // FK
            $table->unsignedBigInteger('id_com'); // FK

            $table->string('email', 120)->comment('Correo Electrónico');
            $table->string('name', 45)->comment('Nombre');
            $table->string('last_name', 45)->comment('Apellido');
            $table->string('address', 255)->comment('Dirección');
            $table->date('date_reg')->comment('Fecha y hora del registro');
            $table->enum('status', ['A', 'I', 'trash'])->comment('estado del registro:\nA: Activo\nI : Desactivo\ntrash : Registro eliminado');


            $table->foreign('id_reg')->references('id_reg')->on('regions');
            $table->foreign('id_com')->references('id_com')->on('communes');
            $table->primary('dni');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
