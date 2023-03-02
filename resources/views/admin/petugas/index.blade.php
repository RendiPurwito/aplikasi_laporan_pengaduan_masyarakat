@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5 class="fw-bold">Petugas</h5>
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group" role="group" aria-label="Third group">
                <a href="{{route('admin.petugas.create')}}" class="btn btn-primary">
                    Create
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table table-striped " id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Telp</th>
                        <th>Email</th>
                        <th data-sortable="false">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($petugas as $row)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $row->nama }}
                        </td>
                        <td>
                            {{ $row->username }}
                        </td>
                        <td>
                            {{ $row->level }}
                        </td>
                        <td>
                            {{ $row->telp }}
                        </td>
                        <td>
                            {{ $row->email }}
                        </td>
                        <td>
                            <a href="{{route('admin.petugas.edit', $row->id)}}" class="btn btn-primary btn-sm"
                                title="Edit petugas '{{ $row->nama }}'">
                                <i class='bx bx-edit-alt'></i>
                            </a>
    
                            <form action="{{ route('admin.petugas.delete', $row->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-button" id="deleteButton"
                                    data-message="Delete '{{ $row->nama }}' ?"
                                    title="Delete '{{ $row->nama }}'">
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