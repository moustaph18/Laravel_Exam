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
        Schema::create('facturation', function (Blueprint $table) {
            $table->id();
            $table->float('Montant');
            $table->date('Date_Paiement');
            $table->string('Moyen_Payement')->default('Carte Bancaire');
            $table->unsignedBigInteger('Location_id');
            $table->foreign('Location_id')->references('id')->on('location')->onUpdate('cascade')->onDelete('cascade');
            Schema::enableForeignKeyConstraints();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturation');
        
        Schema::table('factutaion', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropForeign(['Location_id']);
            
        });
    }
};
