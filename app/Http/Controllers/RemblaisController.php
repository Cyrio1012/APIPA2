<?php

namespace App\Http\Controllers;

use App\Models\Remblais;
use Illuminate\Http\Request;

class RemblaisController extends Controller
{

    public function geojson()
{
    $dossiers = \App\Models\Remblais::whereNotNull('x_long')->whereNotNull('y_lat')->get();

    $features = $dossiers->map(function ($dossier) {
        $color = strtolower($dossier->situation) === 'regularisé' ? '#28a745' : '#dc3545';

        $geometry = $dossier->poly;

        // Si poly est vide ou mal formé, on ignore le polygone
        $validPolygon = is_array($geometry) && isset($geometry['type']) && isset($geometry['coordinates']);

        return [
            'type' => 'Feature',
            'geometry' => $validPolygon ? $geometry : [
                'type' => 'Point',
                'coordinates' => [$dossier->x_long, $dossier->y_lat]
            ],
            'properties' => [
                'id' => $dossier->id,
                'demandeur' => $dossier->demandeur,
                'commune' => $dossier->commune,
                'situation' => $dossier->situation,
                'color' => $color,
                'center' => [$dossier->x_long, $dossier->y_lat],
                'hasPolygon' => $validPolygon
            ]
        ];
    });

    return response()->json([
        'type' => 'FeatureCollection',
        'features' => $features->filter()->values()
    ]);
}


    public function map()
    {
        return view('remblais.map');
    }

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Remblais $remblais)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Remblais $remblais)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Remblais $remblais)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Remblais $remblais)
    {
        //
    }
}
