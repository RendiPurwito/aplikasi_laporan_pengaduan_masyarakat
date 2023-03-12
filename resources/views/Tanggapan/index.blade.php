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
                        {{-- <th>Kategori laporan</th> --}}
                        <th>Judul laporan</th>
                        <th>Tanggapan</th>
                        <th>Petugas</th>
                        <th data-sortable="false">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tanggapan as $row)
                    <tr>
                        <td>
                            {{-- {{ date('Y-m-d', strtotime($row->created_at)) }} --}}
                            {{ $row->created_at->format('l, d F Y')}}
                        </td>
                        {{-- <td>
                            {{ (ucfirst(str_replace('_', ' ', $row->pengaduan->kategori))) }}
                        </td> --}}
                        <td>
                            {{-- {{ $row->pengaduan->isi_laporan }} --}}
                            {{-- {{ Str::limit($row->pengaduan->isi_laporan, 30, '...') }} --}}
                            {{ Str::limit($row->pengaduan->judul_laporan, 20, '...') }}
                        </td>
                        <td>
                            {{ Str::limit($row->tanggapan, 20, '...') }}
                        </td>
                        <td>
                            {{ $row->petugas->nama }}
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#detailModal-{{$row->id}}">
                                <i class='bx bx-detail'></i>
                            </button>

                            @if (Auth::guard('petugas')->user()->level == 'admin')
                                <a href="{{route('tanggapan.pdf', $row->id)}}" class="btn btn-primary btn-sm" title="Export ke pdf">
                                    <i class='bx bxs-file-pdf'></i>
                                </a>
                            @endif
                        </td>
                    </tr>

                    {{--! Modal Detail --}}
                    <div class="modal" id="detailModal-{{$row->id}}" tabindex="-1" aria-hidden="true"
                        style="display: none">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h5 class="modal-title" id="modalCenterTitle">Verifikasi Laporan</h5>
                                    <p class="modal-title">{{ $row->created_at->format('l, d F Y') }}</p>
                                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button> --}}
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <strong>Petugas :</strong>
                                        <p>{{ $row->petugas->nama }}</p>
                                    </div>
                                    <div class="row">
                                        <strong>Judul Laporan :</strong>
                                        <p>{{ $row->pengaduan->judul_laporan }}</p>
                                    </div>
                                    <div class="row">
                                        <strong>Kategori Laporan :</strong>
                                        <p>{{ (ucfirst(str_replace('_', ' ', $row->pengaduan->kategori))) }}</p>
                                    </div>
                                    <div class="row text-wrap">
                                        <strong>Isi Laporan :</strong>
                                        <p>{{ $row->pengaduan->isi_laporan }}</p>
                                    </div>
                                    <div class="row mb-3">
                                        <strong>Foto :</strong>
                                        <img src="/foto/{{$row->pengaduan->foto}}" class="img-thumbnail"
                                            style="width:200px"/>
                                    </div>
                                    <div class="row text-wrap mb-3">
                                        <strong>Tanggapan :</strong>
                                        <textarea class="form-control" rows="5">{{ $row->tanggapan }}</textarea>
                                        {{-- <p>{{ $row->tanggapan }}</p> --}}
                                    </div>
                                    <div class="btn-footer float-end">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection