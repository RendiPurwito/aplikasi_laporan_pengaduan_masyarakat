@extends('layouts.app')

@section('content')
<section class="section dashboard">
    <div class="row">
        <div class="col-3">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Diterima</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-envelope-check"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$diterima}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Diproses</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-envelope-check"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$diproses}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Selesai</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-envelope-check"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$selesai}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Ditolak</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-envelope-x"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$ditolak}}</h6>
                            {{-- {{dd($ditolak)}} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Tanggapan</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-chat-left-text"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$tanggapan}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Petugas</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-person"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$petugas}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Admin</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-person"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$admin}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Masyarakat</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-person"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$masyarakat}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <h1>Chart</h1>
        </div>
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    <canvas id="chart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script>
        var chart = @json($chart);

        var labels = [];
        var values = [];

        chart.forEach(function(item) {
            labels.push(item.kategori);
            values.push(item.total);
        });

        var ctx = document.getElementById('chart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pengaduan berdasarkan Kategori',
                    data: values,
                    backgroundColor: [
                        '#ff6384',
                        '#36a2eb',
                        '#cc65fe',
                        '#ffce56',
                        '#1abc9c',
                        '#2ecc71',
                        '#3498db',
                        '#9b59b6',
                        '#e67e22',
                        '#95a5a6'
                    ]
                }]
            },
            options: {}
        });
    </script>
@endsection