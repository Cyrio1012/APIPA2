<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Action extends Model
{
    protected $fillable = [
        'numero_pv',
        'modele_pv',
        'actions_terrain',
        'proprietaire',
        'commune',
        'localisation',
        'identification_terrain',
        'geom',
        'superficie_m2',
        'destination',
        'montant_amende',
        'infractions_constatees'
    ];

    protected $casts = [
        'actions_terrain' => 'array',
        'geom' => 'array', // GeoJSON
    ];

}
