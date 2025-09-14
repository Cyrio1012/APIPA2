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
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->string('numero_pv')->unique();
            $table->enum('modele_pv', ['PAT', 'FIFAFI']);
            $table->json('actions_terrain');
            $table->string('proprietaire');
            $table->string('commune');
            $table->string('localisation');
            $table->string('identification_terrain');
            $table->json('geom')->nullable(); // GeoJSON stocké en JSON
            $table->float('superficie_m2')->nullable();
            $table->string('destination')->nullable();
            $table->float('montant_amende')->nullable();
            $table->text('infractions_constatees')->nullable();
            $table->string('situation_en_cours')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actions');
    }
};
