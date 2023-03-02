@extends('layouts.app')
@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Verifikasi Laporan</h5>
    </div>
    <div class="card-body">
        <form action="{{route('pengaduan.verifikasi.post', $pengaduan->id)}}" method="POST" id="verifyForm">
            @csrf
            <div class="mb-3">
                <input type="hidden" class="form-control" id="status" name="status" autocomplete="off" value="proses"/>
            </div>

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
            <div class="btn-footer d-flex justify-content-end">
                <a href="{{route('pengaduan.index')}}" class="btn btn-danger me-1 cancel-button">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary" id="submitVerifyButton">Submit</button>
            </div> 
        </form>
    </div>
</div>
@endsection