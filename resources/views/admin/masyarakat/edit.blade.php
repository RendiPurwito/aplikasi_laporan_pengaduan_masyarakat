@extends('layouts.app')
@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit Masyarakat</h5>
    </div>
    <div class="card-body">
        <form action="{{route('admin.masyarakat.update', $data->nik)}}" method="POST" id="editForm">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Nama</label>
                <input type="text" class="form-control" id="basic-default-fullname" placeholder="Nama Petugas" id="nama" name="nama" autocomplete="off" value="{{$data->nama}}"/>
                @error('nama')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-company">Username</label>
                <input type="text" class="form-control" id="basic-default-company" placeholder="ACME Inc." id="username" name="username" autocomplete="off" value="{{$data->username}}"/>
                @error('username')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-phone">No Telp</label>
                <input type="number" id="basic-default-phone" class="form-control phone-mask"
                    placeholder="658 799 8941" name="telp" value="{{$data->telp}}"/>
                    @error('telp')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-email">Email</label>
                <div class="input-group input-group-merge">
                    <input type="text" id="basic-default-email" class="form-control" placeholder="john.doe"
                        aria-label="john.doe" aria-describedby="basic-default-email2" name="email" value="{{$data->email}}"/>
                    <span class="input-group-text" id="basic-default-email2">@gmail.com</span>
                </div>
                @error('email')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="btn-footer d-flex justify-content-end">
                <a href="{{route('admin.petugas.index')}}" class="btn btn-danger me-1 cancel-button">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary" id="submitEditButton">Submit</button>
            </div> 
        </form>
    </div>
</div>
@endsection