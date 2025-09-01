<?php

namespace App\Http\Controllers;

use App\Models\AuditsChantier;
use Illuminate\Http\Request;

class AuditsChantierController extends Controller
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
    public function show(AuditsChantier $auditsChantier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AuditsChantier $auditsChantier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AuditsChantier $auditsChantier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AuditsChantier $auditsChantier)
    {
        //
    }
    public function serviceCategorie()
    {
        $categories = AuditsChantier::select('categorie')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('categorie')
            ->get();

        return view('stats.service_categorie', compact('categories'));
    }
}
