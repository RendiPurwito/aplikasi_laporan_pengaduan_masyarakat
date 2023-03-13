@extends('Layouts.app')
@section('content')
<div class="card mb-4">
    {{-- <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"></h5>
    </div> --}}
    <div class="card-body">
        <form action="{{route('tanggapan.store', $pengaduan->id)}}" method="POST" id="myForm" >
            @csrf

            <div class="mb-3">
                <input type="hidden" class="form-control" id="petugas_id" name="petugas_id" autocomplete="off" value="{{Auth::guard('petugas')->user()->id}}"/>
            </div>

            <div class="mb-3">
                <input type="hidden" class="form-control" id="pengaduan_id" name="pengaduan_id" autocomplete="off" value="{{$pengaduan->id}}"/>
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-company">Isi Laporan</label>
                <p>{{$pengaduan->isi_laporan}}</p>
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-company">Foto</label>
                <img src="/foto/{{$pengaduan->foto}}" class="img-thumbnail" style="width:300px" />
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-company">Tanggapan</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="tanggapan"></textarea>
                @error('tanggapan')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="btn-footer d-flex justify-content-end">
                <a href="{{route('pengaduan.index')}}" class="btn btn-danger me-1 cancel-button">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection