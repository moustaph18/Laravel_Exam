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
        Schema::create('personne', function (Blueprint $table) {
            $table->id();
            $table->string('Pronom',50);
            $table->string('Nom',50);
            $table->string('Adresse',60);
            $table->string('CNI',150);
            $table->string('Login',60);
            $table->string('Mot_de_passe',150);
            $table->integer('Profil')->default('2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personne');
    }
};
