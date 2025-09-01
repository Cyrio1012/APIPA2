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
        Schema::create('demandes_pc', function (Blueprint $table) {
            $table->id();
            $table->year('annee')->nullable();
            $table->string('demandeur')->nullable();
            $table->text('adresse')->nullable();
            $table->text('localisation')->nullable();
            $table->string('commune')->nullable();
            $table->string('proprietaire')->nullable();
            $table->string('titre')->nullable();
            $table->string('immatriculation_terrain')->nullable();
            $table->decimal('x_coord', 10, 6)->nullable();
            $table->decimal('y_coord', 10, 6)->nullable();
            $table->text('prescription_urbanisme')->nullable();
            $table->string('reference')->nullable();
            $table->decimal('superficie_m2', 12, 2)->nullable();
            $table->decimal('superficie_demandee_m2', 12, 2)->nullable();
            $table->string('avis_paiement')->nullable();
            $table->decimal('montant_redevance', 12, 2)->nullable();
            $table->text('situation_redevance')->nullable();
            $table->string('service_envoyeur')->nullable();
            $table->date('date_arrivee_apipa')->nullable();
            $table->date('date_commission_apipa')->nullable();
            $table->text('avis_commission_descente')->nullable();
            $table->text('observation_commission')->nullable();
            $table->text('avis_definitif')->nullable();
            $table->date('date_definitive')->nullable();
            $table->string('categorie')->nullable();
            $table->text('situation_pc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande__pcs');
    }
};
