@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Masyarakat</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped " id="table">
                <thead>
                    <tr>
                        {{-- <th>#</th> --}}
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Telp</th>
                        <th>Email</th>
                        {{-- <th data-sortable="false">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($masyarakat as $row)
                    <tr>
                        {{-- <td>
                            {{ $loop->iteration }}
                        </td> --}}
                        <td>
                            {{ $row->nik }}
                        </td>
                        <td>
                            {{ $row->nama }}
                        </td>
                        <td>
                            {{ $row->username }}
                        </td>
                        <td>
                            {{ $row->telp }}
                        </td>
                        <td>
                            {{ $row->email }}
                        </td>
                        {{-- <td>
                            <a href="{{route('admin.masyarakat.edit', $row->nik)}}" class="btn btn-primary btn-sm"
                                title="Edit '{{ $row->nama }}'">
                                <i class='bx bx-edit-alt'></i>
                            </a>
    
                            <form action="{{ route('admin.masyarakat.delete', $row) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" id="deleteButton"
                                    data-message="Delete '{{ $row->nama }}' ?"
                                    title="Delete '{{ $row->nama }}'">
                                    <i class='bx bx-trash-alt'></i>
                                </button>
                            </form>
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection