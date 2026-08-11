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
        Schema::create('adopcions', function (Blueprint $table) {
            $table->id();
            $table->string('adoptante')->default('Sin adoptar');
            $table->string('folio');
            $table->string('foto')->nullable();
            $table->text('contenido');
            $table->unsignedBigInteger('especie_id');
            $table->foreign('especie_id')->references('id')->on('especies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adopcions');
    }
};
