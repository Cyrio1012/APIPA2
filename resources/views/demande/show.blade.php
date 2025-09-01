@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">📄 Détail de la Demande PC — {{ $demandePc->demandeur }}</h4>
        </div>

        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Année</label>
                    <div class="form-control bg-light">{{ $demandePc->annee }}</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Demandeur</label>
                    <div class="form-control bg-light">{{ $demandePc->demandeur }}</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Propriétaire</label>
                    <div class="form-control bg-light">{{ $demandePc->proprietaire }}</div>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Adresse</label>
                    <div class="form-control bg-light">{{ $demandePc->adresse }}</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Localisation</label>
                    <div class="form-control bg-light">{{ $demandePc->localisation }}</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Commune</label>
                    <div class="form-control bg-light">{{ $demandePc->commune }}</div>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Service Envoyeur</label>
                    <div class="form-control bg-light">{{ $demandePc->service_envoyeur }}</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Date Arrivée APIPA</label>
                    <div class="form-control bg-light">{{ $demandePc->date_arrivee_apipa }}</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Catégorie</label>
                    <div class="form-control bg-light">{{ $demandePc->categorie }}</div>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Situation PC</label>
                    <div class="form-control bg-light">{{ $demandePc->situation_pc }}</div>
                </div>
                <div class="col-md-8">
                    <label class="form-label fw-bold">Avis Définitif</label>
                    <div class="form-control bg-light">{{ $demandePc->avis_definitif }}</div>
                </div>
            </div>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('demande_pc.index') }}" class="btn btn-outline-secondary">← Retour à la liste</a>
        </div>
    </div>
</div>
@endsection
