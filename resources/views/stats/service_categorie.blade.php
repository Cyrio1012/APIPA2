<!-- resources/views/stats/service_envoyeur.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="text-center mb-4">📊 Répartition des Catégories</h3>
    
    <div class="d-flex justify-content-center">
        <div style="width: 400px; height: 400px;">
            <canvas id="categorieChart" width="400" height="400"></canvas>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   const ctxCat = document.getElementById('categorieChart').getContext('2d');

new Chart(ctxCat, {
    type: 'pie',
    data: {
        labels: @json($categories->pluck('categorie')),
        datasets: [{
            data: @json($categories->pluck('total')),
            backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#17a2b8', '#6f42c1', '#fd7e14'],
        }]
    },
    options: {
        responsive: false,
        maintainAspectRatio: false,
        plugins: {
            legend: { position: 'bottom' },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let total = context.dataset.data.reduce((a, b) => a + b, 0);
                        let value = context.raw;
                        let percentage = ((value / total) * 100).toFixed(1);
                        return `${context.label}: ${value} (${percentage}%)`;
                    }
                }
            }
        }
    }
});
</script>
@endsection
