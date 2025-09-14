<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('actions.index');
    }
    public function geojson()
    {
        $colors = [
            "Les Propriétaires  ne se sont pas manifestés" => "#6c757d",
            "AP  emis à la propriétaire" => "#007bff",
            "Préparation  AP" => "#17a2b8",
            "Construction sur canal, Digue , a coté  de station de pompage, occupation emprise" => "#dc3545",
            "FT  de convocation attente complément des dossiers" => "#ffc107",
            "convocation et mise en demeure pour paiement" => "#fd7e14",
            "Projet d’arrêté de scellage" => "#6610f2",
            "Dossier régularisé,amende soldé, paiement encours" => "#28a745"
        ];

        $actions = Action::whereNotNull('geom')->get();

        $features = $actions->map(function ($action) use ($colors) {
            if (!is_array($action->geom)) return null;

            return [
                'type' => 'Feature',
                'geometry' => $action->geom,
                'properties' => [
                    'numero_pv' => $action->numero_pv,
                    'proprietaire' => $action->proprietaire,
                    'commune' => $action->commune,
                    'situation' => $action->situation_en_cours,
                    'color' => $colors[$action->situation_en_cours] ?? '#000000'
                ]
            ];
        })->filter(); // retire les null

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features->values()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('actions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'modele_pv' => 'required|in:PAT,FIFAFI',
            'actions_terrain' => 'required|array',
            'proprietaire' => 'required|string',
            'commune' => 'required|string',
            'localisation' => 'required|string',
            'identification_terrain' => 'required|string',
            'superficie_m2' => 'nullable|numeric',
            'destination' => 'nullable|string',
            'infractions_constatees' => 'nullable|string',
            'geom' => 'nullable|json', // GeoJSON brut
        ]);

        // Génération du numéro PV
        $date = now();
        $mois = str_pad($date->format('m'), 2, '0', STR_PAD_LEFT);
        $annee = $date->format('y');

        $count = Action::whereMonth('created_at', $date->month)
            ->whereYear('created_at', $date->year)
            ->count() + 1;

        $numero_pv = str_pad($count, 2, '0', STR_PAD_LEFT) . "/$mois/$annee";

        // Vérification si le numéro existe déjà
        $existing = Action::where('numero_pv', $numero_pv)->first();
        if ($existing) {
            $existing->update($validated);
            return response()->json(['updated' => true, 'action' => $existing]);
        }

        // Calcul automatique de l’amende
        $validated['montant_amende'] = ($validated['superficie_m2'] ?? 0) * 500;

        // Ajout du numéro PV
        $validated['numero_pv'] = $numero_pv;

        // Enregistrement
        $action = Action::create($validated);

        return response()->json(['created' => true, 'action' => $action]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Action $action)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Action $action)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Action $action)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Action $action)
    {
        //
    }
}
