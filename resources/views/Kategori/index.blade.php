@extends('layouts.app')

@section('content')
<div class="text-end">
    <a href="{{route('kategori.create')}}" class="btn btn-primary mb-3">
        Tambah +
    </a>
</div>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Kategori</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped " id="table">
                <thead>
                    <tr>
                        <th>Nama Kategori</th>
                        <th data-sortable="false">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $row)
                    <tr>
                        <td>
                            {{ $row->nama_kategori }}
                        </td>
                        <td>
                            <a href="" class="btn btn-sm">A</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection