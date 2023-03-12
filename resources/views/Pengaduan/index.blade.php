@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Pengaduan</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped " id="table">
                <thead>
                    <tr>
                        <th>Tgl Pengaduan</th>
                        {{-- <th>Visibilitas</th> --}}
                        <th>Judul Laporan</th>
                        <th>Kategori Laporan</th>
                        <th>Nama Pelapor</th>
                        <th>Status</th>
                        {{-- <th>Isi Laporan</th>
                        <th>Foto</th> --}}
                        <th data-sortable="false">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengaduan as $row)
                    <tr>
                        <td>
                            {{ \Carbon\Carbon::parse($row->created_at)->formatLocalized('%d %B %Y') }}
                            {{-- {{ $row->created_at}} --}}
                        </td>


                        {{-- <td>
                            {{ ucfirst($row->visibilitas) }}
                        </td> --}}

                        <td>
                            {{ Str::limit($row->judul_laporan, 20, '...') }}
                        </td>
                        
                        <td>
                            {{ (ucfirst(str_replace('_', ' ', $row->kategori))) }}
                        </td>
                        
                        <td>
                            {{ $row->masyarakat->nama }}
                        </td>

                        <td>
                            {{-- {{ ucfirst($row->status) }} --}}
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
                        <td>
                            @if ($row->status == 'diterima')
                            {{-- <a href="{{route('pengaduan.verifikasi.get', $row->id)}}" class="btn btn-primary
                            btn-sm"
                            title="Verifikasi Laporan">
                            <i class='bx bx-check'></i>
                            </a> --}}
                            <button type="button" class="btn btn-sm btn-primary" id="verivBtn" data-bs-toggle="modal"
                                data-bs-target="#verifikasiModal-{{$row->id}}">
                                <i class='bx bx-check'></i>
                            </button>

                            <button type="button" class="btn btn-sm btn-danger" id="rejectBtn" data-bs-toggle="modal"
                                data-bs-target="#rejectModal-{{$row->id}}">
                                <i class='bx bx-x'></i>
                            </button>
                            @endif

                            @if ($row->status == 'diproses')
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
                                                    autocomplete="off" value="diproses" />
                                            </div>
                                        </div>
                                        <div class="row text-wrap">
                                            <strong>Judul Laporan :</strong>
                                            <p>{{ $row->judul_laporan }}</p>
                                        </div>
                                        <div class="row">
                                            <strong>Kategori Laporan :</strong>
                                            <p>{{ (ucfirst(str_replace('_', ' ', $row->kategori))) }}</p>
                                        </div>
                                        <div class="row text-wrap">
                                            <strong>Isi Laporan :</strong>
                                            <p>{{ $row->isi_laporan }}</p>
                                        </div>
                                        <div class="row mb-3">
                                            <strong>Foto :</strong>
                                            <img src="/foto/{{$row->foto}}" 
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

                    {{--! Modal Reject --}}
                    <div class="modal" id="rejectModal-{{$row->id}}" tabindex="-1" aria-hidden="true"
                        style="display: none">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h5 class="modal-title" id="modalCenterTitle">Tolak Laporan</h5>
                                    <p class="modal-title">{{ $row->created_at->format('l, d F Y') }}</p>
                                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button> --}}
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('pengaduan.reject', $row->id)}}" method="POST"
                                        id="rejectForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <input type="hidden" class="form-control" id="status" name="status"
                                                    autocomplete="off" value="ditolak" />
                                            </div>
                                        </div>
                                        <div class="row text-wrap">
                                            <strong>Judul Laporan :</strong>
                                            <p>{{ $row->judul_laporan }}</p>
                                        </div>
                                        <div class="row">
                                            <strong>Kategori Laporan :</strong>
                                            <p>{{ (ucfirst(str_replace('_', ' ', $row->kategori))) }}</p>
                                        </div>
                                        <div class="row text-wrap">
                                            <strong>Isi Laporan :</strong>
                                            <p>{{ $row->isi_laporan }}</p>
                                        </div>
                                        <div class="row mb-3">
                                            <strong>Foto :</strong>
                                            <img src="/foto/{{$row->foto}}" 
                                                style="width:200px"/>
                                        </div>
                                        <div class="btn-footer float-end">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-primary"
                                                id="submitRejectButton">Tolak</button>
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
                                        <div class="row text-wrap">
                                            <strong>Judul Laporan :</strong>
                                            <p>{{ $row->judul_laporan }}</p>
                                        </div>
                                        <div class="row">
                                            <strong>Kategori Laporan :</strong>
                                            <p>{{ (ucfirst(str_replace('_', ' ', $row->kategori))) }}</p>
                                        </div>
                                        <div class="row text-wrap">
                                            <strong>Isi Laporan :</strong>
                                            <p>{{ $row->isi_laporan }}</p>
                                        </div>
                                        <div class="row mb-3">
                                            <strong>Foto :</strong>
                                            <img src="/foto/{{$row->foto}}" style="width:200px"/>
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
                                    <div class="row text-wrap">
                                        <strong>Judul Laporan :</strong>
                                        <p>{{ $row->judul_laporan }}</p>
                                    </div>
                                    <div class="row">
                                        <strong>Kategori Laporan :</strong>
                                        <p>{{ (ucfirst(str_replace('_', ' ', $row->kategori))) }}</p>
                                    </div>
                                    <div class="row text-wrap">
                                        <strong>Isi Laporan :</strong>
                                        <p>{{ $row->isi_laporan }}</p>
                                    </div>
                                    <div class="row mb-3">
                                        <strong>Foto :</strong>
                                        <img src="/foto/{{$row->foto}}" style="width:200px"/>
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
