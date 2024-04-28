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
        Schema::create('communes', function (Blueprint $table) {
            $table->unsignedBigInteger('id_com', true); // PK
            $table->unsignedBigInteger('id_reg'); // FK

            $table->string('description', 90);
            $table->enum('status', ['A', 'I', 'trash'])->default('A');

            $table->foreign('id_reg')->references('id_reg')->on('regions');
            $table->primary('id_com');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communes');
    }
};
