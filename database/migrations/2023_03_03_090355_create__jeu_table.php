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
        Schema::create('Jeu', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('description');
            $table->string('langue');
            $table->string('url_media')->default('images/no_image.png');
            $table->integer('age_min');
            $table->integer('nombre_joueurs_min');
            $table->integer('nombre_joueurs_max');
            $table->string('duree_partie');
            $table->boolean('valide')->default(true);
            $table->unsignedBigInteger('categorie_id');
            $table->foreign('categorie_id')->references('id')->on('categorie')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('theme_id');
            $table->foreign('theme_id')->references('id')->on('theme')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('editeur_id');
            $table->foreign('editeur_id')->references('id')->on('editeur')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Jeu');
    }
};
