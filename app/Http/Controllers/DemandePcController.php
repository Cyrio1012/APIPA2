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
    public function serviceCategorie()
    {
        $categories = Demande_Pc::select('categorie')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('categorie')
            ->get();

        return view('stats.service_categorie', compact('categories'));
    }
}
