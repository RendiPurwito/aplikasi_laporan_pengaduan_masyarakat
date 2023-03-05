@extends('Layouts.main')
@section('content')
<h2 class="text-center">Layanan Pengaduan Online Masyarakat</h2>
<div class="card mb-4 mx-5">
    <div class="card-header">
        <h4>Sampaikan Laporan Anda</h4>
    </div>
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
                <label class="form-label" for="basic-default-company">Kategori Laporan</label>
                <select id="defaultSelect" class="form-select" name="kategori">
                    <option selected>Pilih Kategori</option>
                    <option value="agama">Agama</option>
                    <option value="corona_virus">Corona Virus</option>
                    <option value="ekonomi">Ekonomi dan Keuangan</option>
                    <option value="kesehatan">Kesehatan</option>
                    <option value="kesetaraan_gender">Kesetaraan Gender</option>
                    <option value="ketertiban_umum">Ketertiban Umum</option>
                    <option value="lingkungan_hidup">Lingkungan Hidup</option>
                    <option value="pendidikan">Pendidikan</option>
                    <option value="pertanian">Pertanian</option>
                    <option value="peternakan">Peternakan</option>
                    <option value="politik">Politik</option>
                    <option value="kekerasan">Kekerasan</option>
                    <option value="teknologi_informasi">Teknologi Informasi dan Komunikasi</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-company">Judul Laporan</label>
                <input type="text" class="form-control" name="judul_laporan"/>
                @error('judul_laporan')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-company">Isi Laporan</label>
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
            </div>

            <div class="btn-footer d-flex justify-content-end">
                {{-- <a href="{{route('admin.petugas.index')}}" class="btn btn-danger me-1 cancel-button">
                    Cancel
                </a> --}}
                <button type="submit" class="btn btn-primary" id="submitButton">Lapor!</button>
            </div>
        </form>
    </div>
</div>
@endsection