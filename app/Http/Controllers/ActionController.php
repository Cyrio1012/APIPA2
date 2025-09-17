<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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


    public function getCentroid(array $polygon): array
    {
        $coords = Arr::get($polygon, 'coordinates.0', []);
        $x = $y = 0;
        $count = count($coords);

        foreach ($coords as $coord) {
            $x += $coord[0];
            $y += $coord[1];
        }

        return [$x / $count, $y / $count];
    }

    public function geojson(Request $request)
    {
        try {
            $actions = \App\Models\Action::whereNotNull('geom')->get();

            $features = $actions->map(function ($action) {
                $geom = is_string($action->geom) ? json_decode($action->geom, true) : $action->geom;

                if (!is_array($geom) || !isset($geom['type']) || !isset($geom['coordinates'])) {
                    return null;
                }

                $center = $this->getCentroid($geom);

                return [
                    'type' => 'Feature',
                    'geometry' => $geom,
                    'properties' => [
                        'numero_pv' => $action->numero_pv,
                        'proprietaire' => $action->proprietaire,
                        'commune' => $action->commune,
                        'situation' => $action->situation_en_cours,
                        'surface' => (float) $action->superficie_m2,
                        'amende' => (float) $action->montant_amende,
                        'color' => $colors[$action->situation_en_cours] ?? '#000000',
                        'center' => $center
                    ]
                ];
            })->filter()->values();

            return response()->json([
                'type' => 'FeatureCollection',
                'features' => $features
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur serveur'], 500);
        }
    }


    public function map()
    {
        return view('actions.map');
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
