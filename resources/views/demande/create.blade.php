@extends('layouts.app')

@section('content')
    <style>
        input.form-control,
        select.form-select,
        textarea.form-control {
            border: 1.5px solid #ced4da !important;
            box-shadow: none !important;
        }

        input.form-control:focus,
        select.form-select:focus,
        textarea.form-control:focus {
            border-color: #007bff !important;
            outline: none;
            box-shadow: 0 0 0 0.15rem rgba(0, 123, 255, 0.25);
        }
    </style>

    <div class="d-flex flex-column" style="height: 100%; overflow-y: auto; padding: 2rem;">
        <div class="container" style="max-width: 1000px;">
            <h2 class="mb-4">📝 Nouvelle Demande PC</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('demande.store') }}">
                @csrf

                {{-- Groupe 1 : Identité du demandeur --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="demandeur" class="form-label">Demandeur</label>
                        <input type="text" name="demandeur" class="form-control" value="{{ old('demandeur') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="proprietaire" class="form-label">Propriétaire</label>
                        <input type="text" name="proprietaire" class="form-control" value="{{ old('proprietaire') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="annee" class="form-label">Année</label>
                        <select name="annee" class="form-select">
                            @for ($year = 2020; $year <= now()->year; $year++)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                {{-- Groupe 2 : Localisation --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" name="adresse" class="form-control" value="{{ old('adresse') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="localisation" class="form-label">Localisation</label>
                        <input type="text" name="localisation" class="form-control" value="{{ old('localisation') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="commune" class="form-label">Commune</label>
                        <input type="text" name="commune" class="form-control" value="{{ old('commune') }}">
                    </div>
                </div>
                <input type="hidden" name="x_coord" id="x_coord" value="{{ old('x_coord') }}">
                <input type="hidden" name="y_coord" id="y_coord" value="{{ old('y_coord') }}">

                <div class="mb-4">
                    <label class="form-label">📍 Cliquez sur la carte pour capturer les coordonnées</label>
                    <div id="map" style="height: 400px; border: 1px solid #ced4da;"></div>
                </div>

                {{-- Groupe 3 : Dates clés --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="date_arrivee_apipa" class="form-label">Date arrivée APIPA</label>
                        <input type="date" name="date_arrivee_apipa" class="form-control"
                            value="{{ old('date_arrivee_apipa') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="date_commission_apipa" class="form-label">Date commission APIPA</label>
                        <input type="date" name="date_commission_apipa" class="form-control"
                            value="{{ old('date_commission_apipa') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="date_definitive" class="form-label">Date définitive</label>
                        <input type="date" name="date_definitive" class="form-control"
                            value="{{ old('date_definitive') }}">
                    </div>
                </div>

                {{-- Groupe 4 : Classification --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="categorie" class="form-label">Catégorie</label>
                        <select name="categorie" class="form-select">
                            <option value="Regulier">Régulier</option>
                            <option value="Irregulier">Irrégulier</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="situation_pc" class="form-label">Situation PC</label>
                        <select name="situation_pc" class="form-select">
                            <option value="En cours d'études">En cours d'études</option>
                            <option value="Traité">Traité</option>
                            <option value="Non traité">Non traité</option>
                        </select>
                    </div>
                </div>

                {{-- Groupe 5 : Superficie --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="superficie_m2" class="form-label">Superficie (m²)</label>
                        <input type="number" step="0.01" name="superficie_m2" class="form-control"
                            value="{{ old('superficie_m2') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="superficie_demandee_m2" class="form-label">Superficie demandée (m²)</label>
                        <input type="number" step="0.01" name="superficie_demandee_m2" class="form-control"
                            value="{{ old('superficie_demandee_m2') }}">
                    </div>
                </div>

                {{-- Groupe 6 : Terrain & Urbanisme --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="immatriculation_terrain" class="form-label">Immatriculation terrain</label>
                        <input type="text" name="immatriculation_terrain" class="form-control"
                            value="{{ old('immatriculation_terrain') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="prescription_urbanisme" class="form-label">Prescription urbanisme</label>
                        <input type="text" name="prescription_urbanisme" class="form-control"
                            value="{{ old('prescription_urbanisme') }}">
                    </div>
                </div>

                {{-- Groupe 7 : Références & Service --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="reference" class="form-label">Référence</label>
                        <input type="text" name="reference" class="form-control" value="{{ old('reference') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="service_envoyeur" class="form-label">Service envoyeur</label>
                        <input type="text" name="service_envoyeur" class="form-control"
                            value="{{ old('service_envoyeur') }}">
                    </div>
                </div>

                {{-- Groupe 8 : Paiement --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="avis_paiement" class="form-label">Avis de paiement</label>
                        <input type="text" name="avis_paiement" class="form-control"
                            value="{{ old('avis_paiement') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="montant_redevance" class="form-label">Montant redevance</label>
                        <input type="number" step="0.01" name="montant_redevance" class="form-control"
                            value="{{ old('montant_redevance') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="situation_redevance" class="form-label">Situation redevance</label>
                        <input type="text" name="situation_redevance" class="form-control"
                            value="{{ old('situation_redevance') }}">
                    </div>
                </div>

                {{-- Groupe 9 : Avis & Observations --}}
                @foreach (['avis_commission_descente', 'observation_commission', 'avis_definitif'] as $textarea)
                    <div class="mb-3">
                        <label for="{{ $textarea }}"
                            class="form-label">{{ ucfirst(str_replace('_', ' ', $textarea)) }}</label>
                        <textarea name="{{ $textarea }}" class="form-control" rows="3">{{ old($textarea) }}</textarea>
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary mt-3">💾 Enregistrer</button>
            </form>
        </div>
    </div>



    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <script>
        const map = L.map('map').setView([-18.8792, 47.5079], 13); // Antananarivo

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        let marker;

        map.on('click', function(e) {
            const {
                lat,
                lng
            } = e.latlng;

            // Supprimer l'ancien marqueur
            if (marker) map.removeLayer(marker);

            // Ajouter un nouveau marqueur
            marker = L.marker([lat, lng]).addTo(map)
                .bindPopup(`Coordonnées sélectionnées:<br>X: ${lng.toFixed(6)}<br>Y: ${lat.toFixed(6)}`)
                .openPopup();

            // Remplir les champs cachés
            document.getElementById('x_coord').value = lng.toFixed(6);
            document.getElementById('y_coord').value = lat.toFixed(6);
        });
    </script>
@endsection
