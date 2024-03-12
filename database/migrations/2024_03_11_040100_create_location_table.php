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
        Schema::create('location', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Client_id');
            $table->foreign('Client_id')->references('id')->on('personne')->onUpdate('cascade')->onDelete('cascade');
            Schema::enableForeignKeyConstraints();
            $table->unsignedBigInteger('Voiture_id');
            $table->foreign('Voiture_id')->references('id')->on('voiture')->onUpdate('cascade')->onDelete('cascade');
            Schema::enableForeignKeyConstraints();
            $table->string('Lieu_Depart',50);
            $table->string('Lieu_Arrivee',50);
            $table->string('Distance(KM)',40);
            $table->date('Date_Location');
            $table->time('Heure_Debut');
            $table->string('Heure_Fin');
            $table->integer('Paiement')->default(0);
            $table->integer("Etat")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location');

        Schema::table('location', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropForeign(['Client_id']);
            
            Schema::disableForeignKeyConstraints();
            $table->dropForeign(['Voiture_id']);
        });
    }
};
