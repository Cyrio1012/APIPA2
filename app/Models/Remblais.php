<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Remblais extends Model
{
    protected $fillable = [
        'n', 'demandeur', 'adresse', 'localisati', 'commune', 'proprieta', 'titre', 'immatricul',
        'x_coord', 'y_coord', 'poly', 'situation', 'prescripti', 'referenc', 'superficie',
        'superfic_1', 'avis_pa', 'montant_de', 'service_en', 'date_arr', 'date_co',
        'avis_commi', 'observatio', 'avis_defi', 'date_defi', 'categorie', 'annee',
        'x_long', 'y_lat'
    ];

    protected $casts = [
        'poly' => 'array',
    ];
}
