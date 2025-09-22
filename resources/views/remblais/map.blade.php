@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">🗺️ Carte des dossiers</h4>
    <div id="map" style="height: 600px;"></div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const map = L.map('map').setView([-18.8792, 47.5079], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    fetch('/remblais/geojson')
        .then(res => res.json())
        .then(data => {
            L.geoJSON(data, {
                style: feature => feature.properties.hasPolygon ? {
                    color: feature.properties.color,
                    weight: 2,
                    fillOpacity: 0.4
                } : null,
                onEachFeature: (feature, layer) => {
                    const props = feature.properties;
                    const popup = `
                        <strong>Demandeur:</strong> ${props.demandeur}<br>
                        <strong>Commune:</strong> ${props.commune}<br>
                        <strong>Situation:</strong> ${props.situation}
                    `;
                    layer.bindPopup(popup);

                    // 📍 Marker FontAwesome sur le point GPS
                    if (props.center) {
                        const icon = L.divIcon({
                            html: `<i class="fas fa-map-marker-alt" style="color:${props.color}; font-size: 24px;"></i>`,
                            iconSize: [24, 24],
                            className: 'leaflet-fa-icon'
                        });
                        const marker = L.marker([props.center[1], props.center[0]], { icon }).bindPopup(popup);
                        marker.addTo(map);
                    }
                }
            }).addTo(map);
        });
});
</script>
@endsection
