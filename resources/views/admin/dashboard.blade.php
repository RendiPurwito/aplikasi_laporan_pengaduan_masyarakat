@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-12 col-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start">
                    <div class="avatar me-2">
                        <img src="/img/envelope.svg"
                            alt="chart success" class="rounded" />
                    </div>
                    <div>
                        <h4 class="card-title mb-2">{{$belumdiverifikasi}}</h4>
                        <span class="fw-semibold d-block mb-1">Belum Diverifikasi</span>
                        {{-- <div class="btn btn-outline-primary float-end">See More</div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-12 col-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start">
                    <div class="avatar me-2">
                        <img src="/img/envelope-check.svg"
                            alt="chart success" class="rounded" />
                    </div>
                    <div>
                        <h4 class="card-title mb-2">{{$sudahdiverifikasi}}</h4>
                        <span class="fw-semibold d-block mb-1">Sudah Diverifikasi</span>
                        {{-- <div class="btn btn-outline-primary float-end">See More</div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-12 col-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start">
                    <div class="avatar me-2">
                        <img src="/img/envelope-check.svg"
                            alt="chart success" class="rounded" />
                    </div>
                    <div>
                        <h4 class="card-title mb-2">{{$sudahditanggapi}}</h4>
                        <span class="fw-semibold d-block mb-1">Sudah Ditanggapi</span>
                        {{-- <div class="btn btn-outline-primary float-end">See More</div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-12 col-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start">
                    <div class="avatar me-2">
                        <img src="/img/envelope-check.svg"
                            alt="chart success" class="rounded" />
                    </div>
                    <div>
                        <h4 class="card-title mb-2">{{$jumlahtanggapan}}</h4>
                        <span class="fw-semibold d-block mb-1">Tanggapan</span>
                        {{-- <div class="btn btn-outline-primary float-end">See More</div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection