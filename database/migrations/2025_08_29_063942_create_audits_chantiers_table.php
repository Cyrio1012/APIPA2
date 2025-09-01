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
        Schema::create('audits_chantiers', function (Blueprint $table) {
            $table->id();
            $table->date('date_descente')->nullable();
            $table->string('action')->nullable();
            $table->string('numero_pv_pat', 50)->nullable();
            $table->string('numero_fifafi', 50)->nullable();
            $table->text('actions_terrain')->nullable();
            $table->string('proprietaire')->nullable();
            $table->string('commune')->nullable();
            $table->string('fokontany')->nullable();
            $table->text('localisation')->nullable();
            $table->text('identification_terrain')->nullable();
            $table->decimal('x_coord', 10, 6)->nullable();
            $table->decimal('y_coord', 10, 6)->nullable();
            $table->decimal('superficie_m2', 12, 2)->nullable();
            $table->string('destination')->nullable();
            $table->decimal('montant_amende', 12, 2)->nullable();
            $table->text('infractions')->nullable();
            $table->text('suite_a_donner')->nullable();
            $table->boolean('amende_regularisee')->nullable();
            $table->string('numero_pv_apipa', 50)->nullable();
            $table->string('personne_responsable')->nullable();
            $table->text('pieces_fournies')->nullable();
            $table->text('recommandations')->nullable();
            $table->decimal('montant_amende2', 12, 2)->nullable();
            $table->decimal('montant_redevance', 12, 2)->nullable();
            $table->string('reference_avis_paiement')->nullable();
            $table->text('observation')->nullable();
            $table->text('situation_en_cours')->nullable();
            $table->text('situation_finale')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audits_chantiers');
    }
};
