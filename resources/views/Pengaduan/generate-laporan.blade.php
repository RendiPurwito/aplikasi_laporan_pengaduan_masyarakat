@extends('layouts.app')
@section('content')
<div class="row">
    <form method="GET" action="{{ route('pengaduan.generate-laporan') }}">
    <div class="row">
        <div class="form-group col-4">
            <label for="kategori">Kategori:</label>
            <select class="form-control" id="kategori" name="kategori_id">
                <option value="">Semua</option>
                @foreach($kategori as $list)
                <option value="{{ $list->id }}">{{ $list->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        {{-- <div class="form-group col-4">
            <label for="created_at">Tanggal:</label>
            <input type="text" class="form-control" id="created_at" name="created_at" value="" />
        </div> --}}
        
        <div class="form-group col-4">
            <label for="tanggal_awal">Tanggal Awal:</label>
            <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal">
        </div>
        <div class="form-group col-4">
            <label for="tanggal_akhir">Tanggal Akhir:</label>
            <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir">
        </div>
    </div>
    <button type="submit" class="btn btn-primary float-end my-2">Filter</button>
</form>
</div>
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h5 class="card-title">Pengaduan</h5>
            <div class="card-title">
                <a href="{{route('pengaduan.pdf-kategori-tanggal', [
                    'kategori_id' => request('kategori_id'), 
                    'tanggal_awal' => request('tanggal_awal'), 
                    'tanggal_akhir' => request('tanggal_akhir')
                    ])}}" class="btn btn-sm btn-danger">Export to PDF</a>
                <a href="" class="btn btn-sm btn-success">Export to Excel</a>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped" >
                <thead>
                    <tr>
                        <th>Tgl Pengaduan</th>
                        <th>Judul Laporan</th>
                        <th>Kategori Laporan</th>
                        <th>Nama Pelapor</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengaduan as $row)
                    <tr>
                        <td>
                            {{ \Carbon\Carbon::parse($row->created_at)->locale('id')->isoFormat('DD MMMM YYYY') }}
                        </td>

                        <td>
                            {{ Str::limit($row->judul_laporan, 20, '...') }}
                        </td>
                        
                        <td>
                            {{ $row->kategori->nama_kategori }}
                        </td>
                        
                        <td>
                            {{ $row->masyarakat->nama }}
                        </td>

                        <td>
                            @if ($row->status=="diterima")
                                <p class="text-primary">Diterima</p>
                            @elseif($row->status=="diproses")
                                <p class="text-warning">Diproses</p>
                            @elseif($row->status=="selesai")
                                <p class="text-success">Selesai</p>
                            @elseif($row->status=="ditolak")
                                <p class="text-danger">Ditolak</p>
                            @endif
                        </td>
                        
                        {{-- <td>
                            {{ $row->isi_laporan }}
                        {{ Str::limit($row->isi_laporan, 20, '...') }}
                        </td>
                        <td>
                            <a href="{{asset('foto/'.$row->foto)}}" target="_blank" rel="noopener noreferrer">Lihat
                                Gambar</a>
                            <img src="/foto/{{$row->foto}}" class="img-thumbnail" style="width:200px" />
                        </td> --}}
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(function() {
        $('input[name="created_at"]').daterangepicker({
            opens: 'left',
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    });
</script>
@endsection
