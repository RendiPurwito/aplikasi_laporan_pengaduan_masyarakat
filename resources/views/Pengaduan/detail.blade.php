@extends('Layouts.app')
@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Laporan</h5>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <strong>Judul Laporan :</strong>
            <p>{{ $pengaduan->judul_laporan }}</p>
        </div>
        <div class="mb-3">
            <strong>Kategori Laporan :</strong>
            <p>{{ $pengaduan->kategori }}</p>
        </div>
        <div class="mb-3">
            <strong>Isi Laporan :</strong>
            <p>{{ $pengaduan->isi_laporan }}</p>
        </div>
        <div class="mb-3">
            <strong>Foto :</strong>
            <img src="/foto/{{$pengaduan->foto}}" class="img-thumbnail" style="width:200px" />
        </div>
        <div class="mb-3">
            <strong>Tanggal Pengaduan :</strong>
            <p>{{ $pengaduan->created_at }}</p>
        </div>
    </div>
</div>
@endsection