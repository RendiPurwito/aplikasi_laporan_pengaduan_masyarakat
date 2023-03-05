@extends('layouts.app')

@section('content')
<div class="card">
    <h5 class="card-header">Pengaduan</h5>
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table table-striped " id="table">
                <thead>
                    <tr>
                        <th>Tgl Pengaduan</th>
                        <th>Nama Pelapor</th>
                        <th>Kategori Laporan</th>
                        <th>Judul Laporan</th>
                        {{-- <th>Isi Laporan</th>
                        <th>Foto</th> --}}
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
                        <td>
                            {{ $row->masyarakat->nama }}
                        </td>

                        <td>
                            {{ (ucfirst(str_replace('_', ' ', $row->kategori))) }}
                        </td>

                        <td>
                            {{ $row->judul_laporan}}
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
                        <td>
                            {{ ucfirst($row->status) }}
                        </td>
                        <td>
                            @if ($row->status == '0')
                            {{-- <a href="{{route('pengaduan.verifikasi.get', $row->id)}}" class="btn btn-primary
                            btn-sm"
                            title="Verifikasi Laporan">
                            <i class='bx bx-check'></i>
                            </a> --}}
                            <button type="button" class="btn btn-sm btn-primary" id="verivBtn" data-bs-toggle="modal"
                                data-bs-target="#verifikasiModal-{{$row->id}}">
                                <i class='bx bx-check'></i>
                            </button>
                            @endif

                            @if ($row->status == 'proses')
                            {{-- <a href="{{route('tanggapan.create', $row->id)}}" class="btn btn-primary btn-sm"
                            title="Isi Tanggapan">
                            <i class='bx bx-comment'></i>
                            </a> --}}
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#tanggapanModal-{{$row->id}}">
                                <i class='bx bx-comment'></i>
                            </button>
                            @endif

                            {{-- <a href="{{route('pengaduan.detail', $row->id)}}" class="btn btn-primary btn-sm"
                            title="Lihat Detail Laporan">
                            <i class='bx bx-detail'></i>
                            </a> --}}
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#detailModal-{{$row->id}}">
                                <i class='bx bx-detail'></i>
                            </button>
                        </td>
                    </tr>

                    {{--! Modal Verifikasi --}}
                    <div class="modal" id="verifikasiModal-{{$row->id}}" tabindex="-1" aria-hidden="true"
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
                                    <form action="{{route('pengaduan.verifikasi', $row->id)}}" method="POST"
                                        id="verifikasiForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <input type="hidden" class="form-control" id="status" name="status"
                                                    autocomplete="off" value="proses" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <strong>Judul Laporan :</strong>
                                            <p>{{ $row->judul_laporan }}</p>
                                        </div>
                                        <div class="row">
                                            <strong>Kategori Laporan :</strong>
                                            <p>{{ $row->kategori }}</p>
                                        </div>
                                        <div class="row text-wrap">
                                            <strong>Isi Laporan :</strong>
                                            <p>{{ $row->isi_laporan }}</p>
                                        </div>
                                        <div class="row mb-3">
                                            <strong>Foto :</strong>
                                            <img src="/foto/{{$row->foto}}" class="img-thumbnail"
                                                style="width:200px"/>
                                        </div>
                                        <div class="btn-footer float-end">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-primary"
                                                id="submitVerifyButton">Verifikasi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--! Modal Tanggapan --}}
                    <div class="modal" id="tanggapanModal-{{$row->id}}" tabindex="-1" aria-hidden="true"
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
                                    <form action="{{route('tanggapan.store', $row->id)}}" method="POST"
                                        id="tanggapanForm">
                                        @csrf
                                        <div class="row">
                                            <strong>Judul Laporan :</strong>
                                            <p>{{ $row->judul_laporan }}</p>
                                        </div>
                                        <div class="row">
                                            <strong>Kategori Laporan :</strong>
                                            <p>{{ $row->kategori }}</p>
                                        </div>
                                        <div class="row text-wrap">
                                            <strong>Isi Laporan :</strong>
                                            <p>{{ $row->isi_laporan }}</p>
                                        </div>
                                        <div class="row mb-3">
                                            <strong>Foto :</strong>
                                            <img src="/foto/{{$row->foto}}" class="img-thumbnail"
                                                style="width:200px"/>
                                        </div>
                                        <div class="row">
                                            <input type="hidden" class="form-control" id="pengaduan_id" name="pengaduan_id" autocomplete="off" value="{{$row->id}}"/>
                                        </div>
                                        <div class="row">
                                            <input type="hidden" class="form-control" id="petugas_id" name="petugas_id" autocomplete="off" value="{{Auth::guard('petugas')->user()->id}}"/>
                                        </div>
                                        <div class="row mb-3">
                                            <strong>Tanggapan :</strong>
                                            <textarea class="form-control" rows="5" name="tanggapan"></textarea>
                                            @error('tanggapan')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="btn-footer float-end">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-primary"
                                                id="submitTanggapanButton">Tanggapi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                        <strong>Judul Laporan :</strong>
                                        <p>{{ $row->judul_laporan }}</p>
                                    </div>
                                    <div class="row">
                                        <strong>Kategori Laporan :</strong>
                                        <p>{{ $row->kategori }}</p>
                                    </div>
                                    <div class="row text-wrap">
                                        <strong>Isi Laporan :</strong>
                                        <p>{{ $row->isi_laporan }}</p>
                                    </div>
                                    <div class="row mb-3">
                                        <strong>Foto :</strong>
                                        <img src="/foto/{{$row->foto}}" class="img-thumbnail"
                                            style="width:200px"/>
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
