{{-- @extends('layouts.app')

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
@endsection --}}

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">📄 Détail de la Demande PC</h4>
        <a href="{{ route('demande_pc.index', $demandePc->id) }}" class="btn btn-warning">
            ✏️ Modifier
        </a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3">
                @foreach([
                    'Année' => $demandePc->annee,
                    'Demandeur' => $demandePc->demandeur,
                    'Propriétaire' => $demandePc->proprietaire,
                    'Adresse' => $demandePc->adresse,
                    'Localisation' => $demandePc->localisation,
                    'Commune' => $demandePc->commune,
                    'Service Envoyeur' => $demandePc->service_envoyeur,
                    'Date Arrivée APIPA' => $demandePc->date_arrivee_apipa,
                    'Date Commission APIPA' => $demandePc->date_commission_apipa,
                    'Date Définitive' => $demandePc->date_definitive,
                    'Catégorie' => $demandePc->categorie,
                    'Situation PC' => $demandePc->situation_pc,
                    'Superficie (m²)' => $demandePc->superficie_m2,
                    'Superficie demandée (m²)' => $demandePc->superficie_demandee_m2,
                    'Montant Redevance' => $demandePc->montant_redevance,
                    'Situation Redevance' => $demandePc->situation_redevance,
                    'Avis Paiement' => $demandePc->avis_paiement,
                    'Référence' => $demandePc->reference,
                    'Titre' => $demandePc->titre,
                    'Immatriculation Terrain' => $demandePc->immatriculation_terrain,
                ] as $label => $value)
                    <div class="col-md-4">
                        <label class="form-label fw-bold">{{ $label }}</label>
                        <div class="form-control bg-light">{{ $value }}</div>
                    </div>
                @endforeach

                @foreach([
                    'Avis Commission Descente' => $demandePc->avis_commission_descente,
                    'Observation Commission' => $demandePc->observation_commission,
                    'Avis Définitif' => $demandePc->avis_definitif,
                ] as $label => $value)
                    <div class="col-md-12">
                        <label class="form-label fw-bold">{{ $label }}</label>
                        <div class="form-control bg-light" style="min-height: 80px;">{{ $value }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Carte Leaflet --}}
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Localisation sur la carte</h5>
        </div>
        <div class="card-body">
            <div id="map" style="height: 400px; border: 1px solid #ced4da;"></div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.8.0/proj4.js"></script>


<script>
const sourceProj = '+proj=utm +zone=38 +south +ellps=WGS84 +units=m +no_defs';
const destProj = 'EPSG:4326'; // WGS84

const x = {{ $demandePc->x_coord }};
const y = {{ $demandePc->y_coord }};

const [lon, lat] = proj4(sourceProj, destProj, [x, y]);

const map = L.map('map').setView([lat, lon], 15);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
}).addTo(map);

L.marker([lat, lon]).addTo(map)
    .bindPopup("📍 Localisation convertie")
    .openPopup();

</script>
@endsection
