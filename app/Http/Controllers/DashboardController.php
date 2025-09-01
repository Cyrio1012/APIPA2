<?php

namespace App\Http\Controllers;

use App\Models\AuditsChantier;
use App\Models\Demande_Pc;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    // public function showDashboard()
    // {
    //     $stats = [
    //     'service_envoyeur_count' => Demande_Pc::select('service_envoyeur')->count('service_envoyeur'),

    //     'situation_en_cours_count' => AuditsChantier::distinct('situation_en_cours')->count('situation_en_cours'),

    //     'categorie_count' => Demande_Pc::whereIn('categorie', ['Regulier', 'Irregulier', ''])
    //         ->distinct('categorie')
    //         ->count('categorie'),

    //     'situation_pc_count' => Demande_Pc::whereIn('situation_pc', ['En cours d\'études', 'Non traitée', 'Traité'])
    //         ->distinct('situation_pc')
    //         ->count('situation_pc'),
    // ];
    // // dd($stats);
    // return view('dashboard', compact('stats'));
    // }
    public function showDashboard()
    {
        $menuItems = [
            [
                'label' => 'Dashboard',
                'icon' => 'bi bi-house',
                'route' => 'dashboard',
            ],
            [
                'label' => 'Users',
                'icon' => 'bi bi-people',
                'route' => 'users.index',
                'children' => [
                    ['label' => 'All Users', 'route' => 'service-envoyeur'],
                    ['label' => 'Add User', 'route' => 'service-categorie'],
                ],
            ],
            [
                'label' => 'Reports',
                'icon' => 'bi bi-graph-up',
                'route' => 'service-envoyeur',
            ],
        ];
        $stats = [
            'service_envoyeur_count' => Demande_Pc::select('service_envoyeur')->count('service_envoyeur'),

            'situation_en_cours_count' => AuditsChantier::distinct('situation_en_cours')->count('situation_en_cours'),

            'categorie_count' => Demande_Pc::whereIn('categorie', ['Regulier', 'Irregulier', ''])
                ->distinct('categorie')
                ->count('categorie'),

            'situation_pc_count' => Demande_Pc::whereIn('situation_pc', ['En cours d\'études', 'Non traitée', 'Traité'])
                ->distinct('situation_pc')
                ->count('situation_pc'),
        ];
        return view('dashboard', compact('menuItems', 'stats'));
    }
}
