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
                        <th>Judul Laporan</th>
                        <th>Kategori Laporan</th>
                        <th>Nama Pelapor</th>
                        <th>Status</th>
                        <th data-sortable="false">Action</th>
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
                        
                        <td>
                            @if ($row->status == 'diterima')
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
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#tanggapanModal-{{$row->id}}">
                                <i class='bx bx-comment'></i>
                            </button>
                            @endif

                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#detailModal-{{$row->id}}">
                                <i class='bx bx-detail'></i>
                            </button>
                            @if ($row->status=="selesai")
                                <a href="{{route('pengaduan.pdf-id', $row->id)}}" class="btn btn-sm btn-danger">
                                    <i class='bx bxs-file-pdf'></i>
                                </a>
                            @endif
                        </td>
                    </tr>

                    {{--! Modal Verifikasi --}}
                    <div class="modal" id="verifikasiModal-{{$row->id}}" tabindex="-1" aria-hidden="true"
                        style="display: none">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h5 class="modal-title" id="modalCenterTitle">Verifikasi Laporan</h5>
                                    <p class="modal-title">{{\Carbon\Carbon::parse($row->created_at)->locale('id')->isoFormat('dddd, DD MMMM YYYY')}}</p>
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
                                            <p>{{ $row->kategori->nama_kategori }}</p>
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
                                        <div class="row">
                                            <strong>Lokasi :</strong>
                                            <p>{{ $row->lokasi }}</p>
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
                                    <p class="modal-title">{{\Carbon\Carbon::parse($row->created_at)->locale('id')->isoFormat('dddd, DD MMMM YYYY')}}</p>
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
                                            <p>{{ $row->kategori->nama_kategori }}</p>
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
                                        <div class="row">
                                            <strong>Lokasi :</strong>
                                            <p>{{ $row->lokasi }}</p>
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
                                    <p class="modal-title">{{\Carbon\Carbon::parse($row->created_at)->locale('id')->isoFormat('dddd, DD MMMM YYYY')}}</p>
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
                                            <p>{{ $row->kategori->nama_kategori }}</p>
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
                                            <strong>Lokasi :</strong>
                                            <p>{{ $row->lokasi }}</p>
                                        </div>
                                        <div class="row">
                                            <input type="hidden" class="form-control" id="pengaduan_id" name="pengaduan_id" autocomplete="off" value="{{$row->id}}"/>
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
                                    <h5 class="modal-title" id="modalCenterTitle">Detail Laporan</h5>
                                    <p class="modal-title">{{\Carbon\Carbon::parse($row->created_at)->locale('id')->isoFormat('dddd, DD MMMM YYYY')}}</p>
                                </div>
                                <div class="modal-body">
                                    <div class="row text-wrap">
                                        <strong>Judul Laporan :</strong>
                                        <p>{{ $row->judul_laporan }}</p>
                                    </div>
                                    <div class="row">
                                        <strong>Kategori Laporan :</strong>
                                        <p>{{ $row->kategori->nama_kategori }}</p>
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
                                        <strong>Lokasi :</strong>
                                        <p>{{ $row->lokasi }}</p>
                                    </div>
                                    @if ($row->tanggapan)
                                        <div class="row">
                                            <strong>Petugas :</strong>
                                            <p>{{ $row->tanggapan->petugas->nama }}</p>
                                        </div>
                                        <div class="row text-wrap">
                                            <strong>Tanggal Tanggapan :</strong>
                                            <p>{{\Carbon\Carbon::parse($row->tanggapan->created_at)->locale('id')->isoFormat('dddd, DD MMMM YYYY')}}</p>
                                        </div>
                                        <div class="row text-wrap">
                                            <strong>Tanggapan :</strong>
                                            <p>{{ $row->tanggapan->tanggapan }}</p>
                                        </div>
                                    @endif
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
