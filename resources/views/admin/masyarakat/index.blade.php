@extends('layouts.app')

@section('content')
<div class="card">
    <h5 class="card-header">Users</h5>
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table table-striped " id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Telp</th>
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
                            {{ $row->nik }}
                        </td>
                        <td>
                            {{ $row->user->nama }}
                        </td>
                        <td>
                            {{ $row->user->username }}
                        </td>
                        <td>
                            {{ $row->user->telp }}
                        </td>
                        <td>
                            !
                            {{-- <a href="/admin/user/{{ $user->id }}/edit" class="btn btn-primary btn-sm"
                                title="Edit user '{{ $user->name }}'">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
    
                            <form action="{{ route('delUser', $user) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" id="deleteButton"
                                    data-message="Delete user '{{ $user->nama }}' ?"
                                    title="Delete user '{{ $user->nama }}'">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </form> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection