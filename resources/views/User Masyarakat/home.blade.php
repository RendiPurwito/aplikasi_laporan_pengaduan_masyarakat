@extends('layouts.main')
@section('css')
<style>
    .container-p-y:not([class^=pb-]):not([class*=" pb-"]) {
        padding-bottom: 1.625rem !important;
    }

    .masthead {
        min-height: 30rem;
        position: relative;
        display: table;
        width: 100%;
        height: auto;
        padding-top: 8rem;
        padding-bottom: 8rem;
        background: linear-gradient(90deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.1) 100%), url("/img/bg.jpg");
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
@endsection
@section('content')
<header class="masthead d-flex align-items-center mb-3">
    <div class="container px-4 px-lg-5 text-center">
        <h1 class="mb-1 text-white">Selamat Datang</h1>
        <h3 class="mb-5 text-white"><em>Layanan Pengaduan Online Masyarakat</em></h3>
    </div>
</header>

@if (Auth::guard('masyarakats')->user())
<h2>Laporan Terbaru</h2>
<div class="row justify-content-center overflow-auto" style="height: 25rem;">
    @foreach ($pengaduan as $card)
    <div class="card col-10 mb-2">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5 class="card-title me-3">{{$card->judul_laporan}}</h5>
                {{-- <h5 class="card-title me-3">{{ $card->masyarakat->nama}}</h5> --}}
                <p class="card-title">{{ $card->created_at->format('l, d F Y') }}</p>
            </div>
            {{-- <h5 class="card-title">{{$card->judul_laporan}}</h5> --}}
            <p class="card-text">{{$card->isi_laporan}}</p>
            <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar">
                        <img src="/sneat/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <p class="fw-semibold d-block">{{Auth::guard('masyarakats')->user()->nama}}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

<footer class="footer mt-3 py-3 bg-light">
    <div class="container">
        <span class="text-muted">Aplikasi Laporan Pengaduan Masyarakat &copy; {{ date('Y') }}</span>
    </div>
</footer>
@endsection