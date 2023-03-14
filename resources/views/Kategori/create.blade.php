@extends('layouts.app')
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Tambah Kategori</h5>
        <form action="{{route('kategori.store')}}" method="POST" id="myForm">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Nama</label>
                <input type="text" class="form-control" id="basic-default-fullname" placeholder="Nama Petugas" id="nama" name="nama" autocomplete="off" />
                @error('nama')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="btn-footer d-flex justify-content-end">
                <a href="{{route('kategori.index')}}" class="btn btn-danger me-1 cancel-button">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary" id="submitButton">Simpan</button>
            </div> 
        </form>
    </div>
</div>
@endsection