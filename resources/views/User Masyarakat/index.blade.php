@extends('Layouts.main')

@section('content')
<div class="card">
    <h5 class="card-header">Pengaduan</h5>
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table table-striped " id="table">
                <thead>
                    <tr>
                        <th>Tgl Pengaduan</th>
                        {{-- <th>Nama Pelapor</th> --}}
                        <th>Kategori Laporan</th>
                        <th>Judul Laporan</th>
                        <th>Isi Laporan</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th data-sortable="false">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengaduan as $row)
                    <tr>
                        <td>
                            {{ date('Y-m-d', strtotime($row->created_at)) }}
                            {{-- {{ $row->created_at}} --}}
                        </td>
                        {{-- <td>
                            {{ $row->masyarakat->nama }}
                        </td> --}}

                        <td>
                            {{ (ucfirst(str_replace('_', ' ', $row->kategori))) }}
                        </td>

                        <td>
                            {{ $row->judul_laporan}}
                        </td>
                        <td>
                            {{ $row->isi_laporan }}
                            {{ Str::limit($row->isi_laporan, 20, '...') }}
                        </td>
                        <td>
                            <a href="{{asset('foto/'.$row->foto)}}" target="_blank"
                                rel="noopener noreferrer">Lihat Gambar</a>
                            {{-- <img src="/foto/{{$row->foto}}" class="img-thumbnail" style="width:200px" /> --}}
                        </td>
                        <td>
                            {{ ucfirst($row->status) }}
                        </td>
                        <td>
                            <a href="{{route('pengaduan.detail', $row->id)}}" class="btn btn-primary btn-sm" title="Lihat Detail Laporan">
                                <i class='bx bx-detail'></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection