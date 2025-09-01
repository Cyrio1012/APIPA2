@extends('layouts.app')


@section('content')
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}

<div class="min-vh-100">
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="mb-4">
            <h1 class="display-6 fw-bold mb-2">
                <i class="fas fa-chart-line text-primary-custom me-3"></i>
                Dashboard des Statistiques
            </h1>
            <p class="text-muted">
                Vue d'ensemble en temps réel de vos données système
            </p>
        </div>

        <!-- Stats Grid -->
        <div class="row g-4 mb-4">
            <!-- Service Envoyeur -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card stat-card card-rounded shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted small mb-1">Services Envoyeur</p>
                                <p class="stats-number mb-1" id="service-count">{{ $stats['service_envoyeur_count'] ?? 0 }}</p>
                                <p class="small text-success mb-0">
                                    <i class="fas fa-arrow-up"></i> +5% ce mois
                                </p>
                            </div>
                            <div class="icon-wrapper bg-blue-light">
                                <i class="fas fa-paper-plane text-primary fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Catégories -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card stat-card card-rounded shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted small mb-1">Catégories</p>
                                <p class="stats-number mb-1" id="category-count">{{ $stats['categorie_count'] ?? 0 }}</p>
                                <p class="small text-success mb-0">
                                    <i class="fas fa-arrow-up"></i> +2% ce mois
                                </p>
                            </div>
                            <div class="icon-wrapper bg-purple-light">
                                <i class="fas fa-tags text-purple fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Situations en cours -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card stat-card card-rounded shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted small mb-1">Situations en cours</p>
                                <p class="stats-number mb-1" id="situation-progress-count">{{ $stats['situation_en_cours_count'] ?? 0 }}</p>
                                <p class="small text-warning mb-0">
                                    <i class="fas fa-clock pulse-animation"></i> En traitement
                                </p>
                            </div>
                            <div class="icon-wrapper bg-orange-light">
                                <i class="fas fa-hourglass-half text-warning fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Situations PC -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card stat-card card-rounded shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted small mb-1">Situations PC</p>
                                <p class="stats-number mb-1" id="situation-pc-count">{{ $stats['situation_pc_count'] ?? 0 }}</p>
                                <p class="small text-danger mb-0">
                                    <i class="fas fa-exclamation-triangle"></i> Attention requise
                                </p>
                            </div>
                            <div class="icon-wrapper bg-red-light">
                                <i class="fas fa-desktop text-danger fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card stat-card card-rounded shadow-sm">
            <div class="card-body p-4">
                <h2 class="h5 fw-semibold mb-4">
                    <i class="fas fa-bolt text-primary-custom me-2"></i>
                    Actions Rapides
                </h2>
                <div class="row g-3">
                    <div class="col-12 col-md-6 col-lg-3">
                        <button class="btn bg-primary w-100 py-3 btn-action">
                            <i class="fas fa-plus me-2"></i>
                            Nouveau Service
                        </button>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <button class="btn btn-success w-100 py-3 btn-action">
                            <i class="fas fa-folder-plus me-2"></i>
                            Nouvelle Catégorie
                        </button>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <button class="btn btn-warning w-100 py-3 btn-action">
                            <i class="fas fa-file-alt me-2"></i>
                            Créer Situation
                        </button>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <button class="btn btn-info w-100 py-3 btn-action">
                            <i class="fas fa-chart-bar me-2"></i>
                            Voir Rapports
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Refresh Info -->
        <div class="mt-4 text-center">
            <p class="text-muted small">
                <i class="fas fa-sync-alt me-1"></i>
                Dernière mise à jour: <span id="last-updated">--</span>
            </p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      

        // Fonction pour rafraîchir les données
        function refreshData() {
            // Remplacer par votre appel API Laravel
            fetch('/dashboard')
                .then(response => response.json())
                .then(data => updateStats(data));
            
            console.log('Données rafraîchies');
        }

        // Auto-refresh toutes les 30 secondes
        setInterval(refreshData, 10000);
    </script>
</div>

@endsection 
