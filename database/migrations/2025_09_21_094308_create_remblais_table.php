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
        Schema::create('remblais', function (Blueprint $table) {
            $table->id();
            $table->integer('n')->nullable();
            $table->string('demandeur')->nullable();
            $table->string('adresse')->nullable();
            $table->string('localisati')->nullable();
            $table->string('commune')->nullable();
            $table->string('proprieta')->nullable();
            $table->string('titre')->nullable();
            $table->string('immatricul')->nullable();
            $table->integer('x_coord')->nullable();
            $table->integer('y_coord')->nullable();
            $table->json('poly')->nullable();
            $table->string('situation')->nullable();
            $table->string('prescripti')->nullable();
            $table->string('referenc')->nullable();
            $table->integer('superficie')->nullable();
            $table->integer('superfic_1')->nullable();
            $table->string('avis_pa')->nullable();
            $table->integer('montant_de')->nullable();
            $table->string('service_en')->nullable();
            $table->string('date_arr')->nullable();
            $table->string('date_co')->nullable();
            $table->string('avis_commi')->nullable();
            $table->text('observatio')->nullable();
            $table->string('avis_defi')->nullable();
            $table->string('date_defi')->nullable();
            $table->string('categorie')->nullable();
            $table->integer('annee')->nullable();
            $table->double('x_long', 15, 8)->nullable();
            $table->double('y_lat', 15, 8)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remblais');
    }
};
