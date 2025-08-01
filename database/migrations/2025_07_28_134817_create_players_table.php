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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->integer('height');
            $table->float('weight');
            $table->enum('position', ['penyerang', 'gelandang', 'bertahan', 'penjaga gawang']);
            $table->integer('shirt_number');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['team_id', 'shirt_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
