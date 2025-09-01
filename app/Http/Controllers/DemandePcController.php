<?php

namespace App\Http\Controllers;

use App\Models\Demande_Pc;
use Illuminate\Http\Request;

class DemandePcController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $annees = range(2020, now()->year);
        return view('demande.create', compact('annees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'annee' => 'required|integer|min:2020|max:' . now()->year,
            'demandeur' => 'required|string|max:255',
            'adresse' => 'nullable|string',
            'localisation' => 'nullable|string',
            'commune' => 'nullable|string',
            'proprietaire' => 'nullable|string',
            'titre' => 'nullable|string',
            'immatriculation_terrain' => 'nullable|string',
            'prescription_urbanisme' => 'nullable|string',
            'reference' => 'nullable|string',
            'superficie_m2' => 'nullable|numeric',
            'superficie_demandee_m2' => 'nullable|numeric',
            'avis_paiement' => 'nullable|string',
            'montant_redevance' => 'nullable|numeric',
            'situation_redevance' => 'nullable|string',
            'service_envoyeur' => 'nullable|string',
            'date_arrivee_apipa' => 'nullable|date',
            'date_commission_apipa' => 'nullable|date',
            'avis_commission_descente' => 'nullable|string',
            'observation_commission' => 'nullable|string',
            'avis_definitif' => 'nullable|string',
            'date_definitive' => 'nullable|date',
            'categorie' => 'required|string|in:Regulier,Irregulier,Autre',
            'situation_pc' => 'required|string|in:En cours d\'etudes,Traité,Non traité',
        ]);

        Demande_Pc::create($validated);

        return redirect()->back()->with('success', 'Demande enregistrée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Demande_Pc $demande_Pc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Demande_Pc $demande_Pc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Demande_Pc $demande_Pc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Demande_Pc $demande_Pc)
    {
        //
    }

    public function serviceEnvoyeurStats()
    {
        $stats = Demande_Pc::select('service_envoyeur')
            ->groupBy('service_envoyeur')
            ->selectRaw('service_envoyeur, COUNT(*) as total')
            ->get();

        return view('stats.service_envoyeur', compact('stats'));
    }
/*************  ✨ Windsurf Command 🌟  *************/
    public function serviceCategorie()
    {
        $categories = Demande_Pc::select('categorie')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('categorie')
            ->get();

        return view('stats.service_categorie', compact('categories'));
    }
/*******  1fcabaff-b3e8-4b34-b42c-5496b10fa497  *******/
}
