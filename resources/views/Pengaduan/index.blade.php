@extends('layouts.app')

@section('content')
<div class="card">
    <h5 class="card-header">Pengaduan</h5>
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table table-striped " id="table">
                <thead>
                    <tr>
                        <th>Tanggal Pengaduan</th>
                        <th>Nama Pelapor</th>
                        <th>Isi Laporan</th>
                        <th>Foto</th>
                        <th>Status</th>
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
                            {{ $row->masyarakat->nama }}
                        </td>
                        <td>
                            {{ $row->isi_laporan }}
                        </td>
                        <td>
                            @if ($row->foto != "null")
                                <img src="/foto/{{$row->foto}}" class="img-thumbnail" style="width:200px" />
                            @endif
                        </td>
                        <td>
                            {{ ucfirst($row->status) }}
                        </td>
                        <td>
                            {{-- <a href="" class="btn btn-primary btn-sm">
                                <i class='bx bx-edit-alt'></i>
                            </a> --}}

                            @if ($row->status == '0')
                                <a href="{{route('tanggapan.create', $row)}}" class="btn btn-primary btn-sm" title="Isi Tanggapan">
                                    <i class='bx bx-comment'></i>
                                </a>
                            @endif

                            <a href="{{route('tanggapan.create', $row)}}" class="btn btn-primary btn-sm" title="Lihat Detail Laporan">
                                <i class='bx bx-detail'></i>
                            </a>
    
                            <form action="" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" id="deleteButton"
                                    data-message="Delete  '{{ $row->id }}' ?" title="Hapus Laporan">
                                    <i class='bx bx-trash-alt'></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection