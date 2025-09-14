@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">📍 Carte des Actions Terrain</h4>
    <div id="map" style="height: 600px;"></div>
</div>
<a href="{{ route('actions.create') }}"  rel="noopener noreferrer">Ajouter une Action</a>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<script>
document.addEventListener('DOMContentLoaded', () => {
    const map = L.map('map').setView([-18.8792, 47.5079], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    fetch('/actions/geojson')
        .then(res => res.json())
        .then(data => {
            L.geoJSON(data, {
                style: feature => ({
                    color: feature.properties.color,
                    weight: 2,
                    fillOpacity: 0.5
                }),
                onEachFeature: (feature, layer) => {
                    const props = feature.properties;
                    const popup = `
                        <strong>PV:</strong> ${props.numero_pv}<br>
                        <strong>Propriétaire:</strong> ${props.proprietaire}<br>
                        <strong>Commune:</strong> ${props.commune}<br>
                        <strong>Situation:</strong> ${props.situation}
                    `;
                    layer.bindPopup(popup);
                }
            }).addTo(map);
        });

    // 🧭 Légende
    const legend = L.control({ position: 'bottomright' });
    legend.onAdd = function () {
        const div = L.DomUtil.create('div', 'info legend');
        const situations = {
            "Les Propriétaires  ne se sont pas manifestés": "#6c757d",
            "AP  emis à la propriétaire": "#007bff",
            "Préparation  AP": "#17a2b8",
            "Construction sur canal, Digue , a coté  de station de pompage, occupation emprise": "#dc3545",
            "FT  de convocation attente complément des dossiers": "#ffc107",
            "convocation et mise en demeure pour paiement": "#fd7e14",
            "Projet d’arrêté de scellage": "#6610f2",
            "Dossier régularisé,amende soldé, paiement encours": "#28a745"
        };
        div.innerHTML += '<strong>🗂️ Légende</strong><br>';
        for (const [label, color] of Object.entries(situations)) {
            div.innerHTML += `<i style="background:${color};width:18px;height:18px;display:inline-block;margin-right:8px;"></i>${label}<br>`;
        }
        return div;
    };
    legend.addTo(map);
});
</script>
<style>
.legend {
    background: white;
    padding: 10px;
    font-size: 14px;
    line-height: 1.5;
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
    border-radius: 5px;
}
</style>
@endsection
