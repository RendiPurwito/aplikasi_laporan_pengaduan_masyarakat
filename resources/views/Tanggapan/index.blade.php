@extends('layouts.app')

@section('content')
<div class="card">
    <h5 class="card-header">Tanggapan</h5>
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table table-striped " id="table">
                <thead>
                    <tr>
                        <th>Tgl Tanggapan</th>
                        <th>Kategori laporan</th>
                        <th>Judul laporan</th>
                        <th>Tanggapan</th>
                        <th>Petugas</th>
                        <th data-sortable="false">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                    <tr>
                        <td>
                            {{-- {{ date('Y-m-d', strtotime($row->created_at)) }} --}}
                            {{ $row->created_at}}
                        </td>
                        <td>
                            {{ (ucfirst(str_replace('_', ' ', $row->pengaduan->kategori))) }}
                        </td>
                        <td>
                            {{-- {{ $row->pengaduan->isi_laporan }} --}}
                            {{-- {{ Str::limit($row->pengaduan->isi_laporan, 30, '...') }} --}}
                            {{ $row->pengaduan->judul_laporan}}
                        </td>
                        <td>
                            {{ $row->tanggapan }}
                        </td>
                        <td>
                            {{ $row->petugas->nama }}
                        </td>
                        <td>
                            <a href="" class="btn btn-primary btn-sm">
                                <i class='bx bx-detail'></i>
                            </a>

                            @if (Auth::guard('petugas')->user()->level == 'admin')
                                <a href="{{route('tanggapan.pdf', $row->id)}}" class="btn btn-primary btn-sm" title="Export ke pdf">
                                    <i class='bx bxs-file-pdf'></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection