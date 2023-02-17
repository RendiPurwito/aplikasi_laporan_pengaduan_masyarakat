@extends('Layouts.main')

@section('content')
<div class="card">
    <h5 class="card-header">Pengaduan</h5>
    <div class="card-body">
        <div class="">
            <table class="table table-striped " id="table">
                <thead>
                    <tr>
                        <th>#</th>
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
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ date('Y-m-d', strtotime($row->created_at)) }}
                        </td>
                        <td>
                            {{ $row->masyarakat->nama }}
                        </td>
                        <td>
                            {{ $row->isi_laporan }}
                        </td>
                        <td>
                            <img src="/foto/{{$row->foto}}" class="img-thumbnail" style="width:200px" />
                        </td>
                        <td>
                            {{ ucfirst($row->status) }}
                        </td>
                        <td>
                            <a href="" class="btn btn-primary btn-sm">
                                <i class='bx bx-edit-alt'></i>
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