<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demande_Pc extends Model
{
    protected $table = 'demandes_pc';
    protected $guarded = [];

    protected $fillable = [
        'annee',
        'demandeur',
        'adresse',
        'localisation',
        'commune',
        'proprietaire',
        'titre',
        'immatriculation_terrain',
        'x_coord',
        'y_coord',
        'prescription_urbanisme',
        'reference',
        'superficie_m2',
        'superficie_demandee_m2',
        'avis_paiement',
        'montant_redevance',
        'situation_redevance',
        'service_envoyeur',
        'date_arrivee_apipa',
        'date_commission_apipa',
        'avis_commission_descente',
        'observation_commission',
        'avis_definitif',
        'date_definitive',
        'categorie',
        'situation_pc',
    ];
}
