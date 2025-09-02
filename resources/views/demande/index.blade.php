@extends('layouts.app')

@section('content')
    <h4 class="mb-3">📋 Liste des Demandes PC</h4>

    <div class="search-container mb-3">
        <div class="position-relative">
            <i class="fas fa-search position-absolute" style="top: 10px; left: 10px;"></i>
            <input type="text" class="form-control ps-4" id="searchInput"
                placeholder="Rechercher par demandeur, adresse, commune, etc.">
                <a href="{{ route('demande.create') }}" class="btn btn-success"> Nouvelle Demande</a>
        </div>
    </div>

    <table class="table table-bordered" id="demandeTable" >
        <thead>
            <tr>
                <th>Année</th>
                <th>Demandeur</th>
                <th>Adresse</th>
                <th>Localisation</th>
                <th>Commune</th>
                <th>Propriétaire</th>
                <th>Service Envoyeur</th>
                <th>Date Arrivée APIPA</th>
                <th>Avis Définitif</th>
                <th>Catégorie</th>
                <th>Situation PC</th>
            </tr>
        </thead>
        <tbody id="demandeTable">
            @foreach ($demandepc as $d)
                <tr class="demande-row" onclick="window.location='{{ route('demande_pc.show', $d) }}'" style="cursor:pointer;">
                        <td>{{ $d->annee }}</td>
                        <td>{{ $d->demandeur }}</td>
                        <td>{{ $d->adresse }}</td>
                        <td>{{ $d->localisation }}</td>
                        <td>{{ $d->commune }}</td>
                        <td>{{ $d->proprietaire }}</td>
                        <td>{{ $d->service_envoyeur }}</td>
                        <td>{{ $d->date_arrivee_apipa }}</td>
                        <td>{{ $d->avis_definitif }}</td>
                        <td>{{ $d->categorie }}</td>
                        <td>{{ $d->situation_pc }}</td>
                    </a>
            @endforeach
        </tbody>
    </table>

    {{ $demandepc->links() }}



    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('searchInput');
            const rows = document.querySelectorAll('.demande-row');

            searchInput.addEventListener('input', () => {
                const term = searchInput.value.toLowerCase();

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(term) ? '' : 'none';
                });
            });
        });
    </script>
@endsection
@section('scripts')
<script>

    $('#demandeTable').bootstrapTable({
    search: true,
    sidePagination: 'client',
});
</script>
@endsection