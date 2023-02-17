@extends('Layouts.main')
@section('content')
<div class="card mb-4">
    {{-- <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"></h5>
    </div> --}}
    <div class="card-body">
        <form action="{{route('pengaduan.store')}}" method="POST" id="myForm" enctype="multipart/form-data">
            @csrf
            {{-- <div class="mb-3">
                <label for="html5-date-input" class="col-md-2 col-form-label">Tanggal
                    Pengaduan</label>
                <div class="col-md-12">
                    <input class="form-control" type="date" value="2021-06-18"
                        id="html5-date-input" name="tgl_pengaduan" />
                </div>
            </div> --}}

            <div class="mb-3">
                <input type="hidden" class="form-control" id="nik_pelapor" name="nik_pelapor" autocomplete="off" value="{{Auth::guard('masyarakats')->user()->nik}}"/>
            </div>

            <div class="mb-3">
                <input type="hidden" class="form-control" id="status" name="status" autocomplete="off" value="0"/>
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-company">Laporan</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="isi_laporan"></textarea>
                @error('isi_laporan')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Foto</label>
                <input class="form-control" type="file" id="formFile" name="foto" />
                @error('foto')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="btn-footer d-flex justify-content-end">
                {{-- <a href="{{route('admin.petugas.index')}}" class="btn btn-danger me-1 cancel-button">
                    Cancel
                </a> --}}
                <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection