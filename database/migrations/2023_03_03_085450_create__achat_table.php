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
        Schema::create('Achat', function (Blueprint $table) {
            $table->id();
            $table->string('lieu_achat',50);
            $table->dateTime('date_achat');
            $table->integer('prix');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('User')->onDelete('cascade');
            $table->unsignedBigInteger('jeu_id');
            $table->foreign('jeu_id')->references('id')->on('Jeu')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Achat');
    }
};
