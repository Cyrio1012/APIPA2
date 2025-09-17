@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h4 class="mb-4">🗺️ Carte des terrains tracés</h4>

        <div class="row mb-3">
            <div class="col-md-4">
                <select id="communeFilter" class="form-control">
                    <option value="">Toutes les communes</option>
                    <option value="CUA">CUA</option>
                    <option value="Alasora">Alasora</option>
                    <option value="Ambohimangakely">Ambohimangakely</option>
                </select>
            </div>
            <div class="col-md-6">
                <select id="situationFilter" class="form-control">
                    <option value="">Toutes les situations</option>
                    <option value="Les Propriétaires  ne se sont pas manifestés">Les Propriétaires ne se sont pas manifestés
                    </option>
                    <option value="AP  emis à la propriétaire">AP emis à la propriétaire</option>
                    <option value="Préparation  AP">Préparation AP</option>
                    <option value="Construction sur canal, Digue , a coté  de station de pompage, occupation emprise">
                        Construction sur canal, Digue…</option>
                    <option value="FT  de convocation attente complément des dossiers">FT de convocation…</option>
                    <option value="convocation et mise en demeure pour paiement">Convocation et mise en demeure</option>
                    <option value="Projet d’arrêté de scellage">Projet d’arrêté de scellage</option>
                    <option value="Dossier régularisé,amende soldé, paiement encours">Dossier régularisé…</option>
                </select>
            </div>
            <div class="col-md-2">
                <button id="filterBtn" class="btn btn-primary w-100">Filtrer</button>
            </div>
        </div>

        <div id="map" style="height: 600px;"></div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const map = L.map('map').setView([-18.8792, 47.5079], 14);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            let layerGroup;

            function createFontAwesomeMarker(color, iconClass = 'fa-map-marker-alt') {
                return L.divIcon({
                    html: `<i class="fas ${iconClass}" style="color:${color}; font-size: 24px;"></i>`,
                    iconSize: [24, 24],
                    className: 'leaflet-fa-icon'
                });
            }


            function loadGeoJSON(commune = '', situation = '') {
                const url = new URL('/actions/geojson', window.location.origin);
                if (commune) url.searchParams.append('commune', commune);
                if (situation) url.searchParams.append('situation', situation);

                fetch(url)
                    .then(res => res.json())
                    .then(data => {
                        if (layerGroup) map.removeLayer(layerGroup);
                        layerGroup = L.geoJSON(data, {
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
                    <strong>Situation:</strong> ${props.situation}<br>
                    <strong>Surface:</strong> ${Number(props.surface)?.toFixed(2)} m²<br>
                    <strong>Amende:</strong> ${Number(props.amende)?.toLocaleString()} Ar
                `;
                                layer.bindPopup(popup);

                                // 📍 Ajout du marker coloré
                                if (props.center) {
                                    const marker = L.marker([props.center[1], props.center[0]], {
                                        icon: createFontAwesomeMarker(props.color)
                                    }).bindPopup(popup);
                                    marker.addTo(map);
                                }


                            }
                        }).addTo(map);
                    });

            }

            loadGeoJSON();

            document.getElementById('filterBtn').addEventListener('click', () => {
                const commune = document.getElementById('communeFilter').value;
                const situation = document.getElementById('situationFilter').value;
                loadGeoJSON(commune, situation);
                console.log('Filtrage lancé:', commune, situation);

            });
        });
    </script>
@endsection
