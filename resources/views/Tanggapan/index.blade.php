@extends('layouts.app')

@section('content')
<div class="card">
    <h5 class="card-header">Tanggapan</h5>
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table table-striped " id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pengaduan</th>
                        <th>Tgl Tanggapan</th>
                        <th>Tanggapan</th>
                        <th>Petugas</th>
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
                            {{ $row->pengaduan->isi_laporan }}
                            {{-- {{ $row->pengaduan_id}} --}}
                        </td>
                        <td>
                            {{ date('Y-m-d', strtotime($row->created_at)) }}
                        </td>
                        <td>
                            {{ $row->tanggapan }}
                        </td>
                        <td>
                            {{ $row->petugas->nama }}
                        </td>
                        <td>
                            <a href="" class="btn btn-primary btn-sm">
                                <i class='bx bx-edit-alt'></i>
                            </a>
    
                            <form action="" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" id="deleteButton">
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