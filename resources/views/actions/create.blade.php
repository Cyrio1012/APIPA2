@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h4 class="mb-4">📝 Créer une Action Terrain</h4>

        <form method="POST" action="{{ route('actions.store') }}">
            @csrf

            {{-- Actions terrain --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Actions faites sur terrain</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="actions_terrain[]" value="DEPOT_PV" id="depotPv">
                    <label class="form-check-label" for="depotPv">Dépôt PV</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="actions_terrain[]" value="ARRET_TRAVAUX"
                        id="arretTravaux">
                    <label class="form-check-label" for="arretTravaux">Arrêt interruptif de travaux</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="actions_terrain[]" value="NON_RESPECT"
                        id="nonRespect">
                    <label class="form-check-label" for="nonRespect">Non-respect de l'arrêt interruptif</label>
                </div>
            </div>

            {{-- Modèle PV --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Modèle de PV</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="modele_pv" value="PAT" id="pvPat" required>
                    <label class="form-check-label" for="pvPat">PAT</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="modele_pv" value="FIFAFI" id="pvFifafi">
                    <label class="form-check-label" for="pvFifafi">FIFAFI</label>
                </div>
            </div>

            {{-- Informations terrain --}}
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Propriétaire</label>
                    <input type="text" name="proprietaire" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Commune</label>
                    <input type="text" name="commune" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Localisation</label>
                    <input type="text" name="localisation" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Identification du terrain</label>
                    <input type="text" name="identification_terrain" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Superficie du terrain (m²)</label>
                    <input type="number" name="superficie_m2" class="form-control" id="superficie" step="0.01">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Destination</label>
                    <input type="text" name="destination" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Montant de l'amende (Ar)</label>
                    <input type="number" name="montant_amende" class="form-control" id="amende" readonly>
                </div>
            </div>

            {{-- Infractions --}}
            <div class="mt-3">
                <label class="form-label">Infractions constatées</label>
                <textarea name="infractions_constatees" class="form-control" rows="4"></textarea>
            </div>

            {{-- Carte --}}
            <div class="mt-4">
                <label class="form-label fw-bold">📍 Localisation géographique</label>
                <button type="button" class="btn btn-outline-primary btn-sm mb-2" id="locateBtn">📍 Voir ma
                    position</button>
                <div id="map" style="height: 400px; border: 1px solid #ccc;"></div>
            </div>

            <input type="hidden" name="geom" id="geomField">

            <div class="mt-4">
                <button type="submit" class="btn btn-success">✅ Enregistrer l'action</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />

<script>
document.addEventListener('DOMContentLoaded', () => {
    // 📦 Définir les couches de base
    const osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    });

    const satellite = L.tileLayer('https://services.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{x}/{y}', {
        attribution: 'Tiles © Esri — Source: Esri, Maxar, Earthstar Geographics',
        maxZoom: 19
    });

    // 🗺️ Initialiser la carte
    const map = L.map('map', {
        center: [-18.8792, 47.5079],
        zoom: 15,
        layers: [satellite] // Choisir la couche par défaut ici
    });

    // 🔄 Contrôle de bascule
    const baseMaps = {
        "Vue standard 🗺️": osm,
        "Vue satellite 🌍": satellite
    };
    L.control.layers(baseMaps).addTo(map);

    // ✏️ Dessin
    const drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);

    const drawControl = new L.Control.Draw({
        draw: {
            polygon: true,
            polyline: false,
            marker: true,
            circle: false,
            rectangle: false
        },
        edit: {
            featureGroup: drawnItems
        }
    });
    map.addControl(drawControl);

    map.on('draw:created', function (e) {
        drawnItems.clearLayers();
        drawnItems.addLayer(e.layer);
        const geojson = e.layer.toGeoJSON();
        document.getElementById('geomField').value = JSON.stringify(geojson.geometry);
    });

    // 📍 Bouton "Voir ma position"
    document.getElementById('locateBtn').addEventListener('click', () => {
        map.locate({ setView: true, maxZoom: 17 });
    });

    map.on('locationfound', function (e) {
        L.marker(e.latlng).addTo(map).bindPopup("📍 Vous êtes ici").openPopup();
    });
});
</script>
<script>
    // Calcul du montant de l'amende basé sur la superficie
    document.getElementById('superficie').addEventListener('input', function() {
        const superficie = parseFloat(this.value) || 0;
        let amende = 0;

        if (superficie <= 100) {
            amende = 100000;
        } else if (superficie <= 500) {
            amende = 500000;
        } else if (superficie <= 1000) {
            amende = 1000000;
        } else {
            amende = 5000000;
        }

        document.getElementById('amende').value = amende;
    });
@endsection
