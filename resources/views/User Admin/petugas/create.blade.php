@extends('layouts.app')
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Tambah Petugas</h5>
        <form action="{{route('admin.petugas.store')}}" method="POST" id="myForm">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Nama</label>
                <input type="text" class="form-control" id="basic-default-fullname" placeholder="Nama Petugas" id="nama" name="nama" autocomplete="off" />
                @error('nama')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-company">Username</label>
                <input type="text" class="form-control" id="basic-default-company" placeholder="Username" id="username" name="username" autocomplete="off"/>
                @error('username')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-company">Level</label>
                <select id="defaultSelect" class="form-select" name="level">
                    <option selected>Pilih Level</option>
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-company">Password</label>
                <input type="text" class="form-control" id="basic-default-company" placeholder="Password" name="password"/>
                @error('password')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="basic-default-phone">No Telp</label>
                <input type="number" id="basic-default-phone" class="form-control phone-mask"
                    placeholder="No Telepon" name="telp"/>
                    @error('telp')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-email">Email</label>
                <div class="input-group input-group-merge">
                    <input type="text" id="basic-default-email" class="form-control" placeholder="Email"
                        aria-label="john.doe" aria-describedby="basic-default-email2" name="email"/>
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
                    Batal
                </a>
                <button type="submit" class="btn btn-primary" id="submitButton">Simpan</button>
            </div> 
        </form>
    </div>
</div>
@endsection