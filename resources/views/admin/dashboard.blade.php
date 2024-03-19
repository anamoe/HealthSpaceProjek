@extends('layouts.main')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card bg-success-dark px-5 py-2 text-white">
        <div class="d-flex justify-content-between">
            <div class="judul d-flex flex-column justify-content-center">
                <h4 class="text-white mb-0">SPACE HEALTH</h4>
                <h6 class="text-white mt-0">Dashboard</h6>
            </div>
            <div class="doctor">
                <img src="{{url('assets/img/doctor.png')}}" height="150" alt="">
            </div>
        </div>
    </div>


    <div class="row mt-3">

        <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="menu-icon tf-icons bx bx-first-aid card-title" style="font-size : 45px;"></i>
                        </div>

                    </div>
                    <span class="fw-medium d-block mb-1">Poli</span>
                    <h3 class="card-title mb-2">7</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="menu-icon tf-icons bx bx-git-repo-forked card-title" style="font-size : 45px;"></i>
                        </div>

                    </div>
                    <span class="fw-medium d-block mb-1">Dokter</span>
                    <h3 class="card-title mb-2">6</h3>
                </div>
            </div>
        </div>

    </div>


</div>

@endsection