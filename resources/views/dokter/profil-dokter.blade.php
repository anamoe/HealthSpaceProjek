@extends('layouts.main')

@section('content')
<h5 class="fw-semibold">
<a href="{{url('peternak/dashboard')}}"><i class="ti ti-arrow-left bg-danger rounded-circle text-white"></i></a>
Edit Profil</h5>
<div class="section mb-5 p-2">
    <form action="{{url('peternak/profil')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
            <div class="text-center mb-3">
                    <img src="{{asset('public/images/profil/'.auth()->user()->foto)}}" alt="Profil Image" class="rounded-circle" width="100" height="100">
                    <input type="file" name="foto" accept="image/*">
                </div>

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="email">Email</label>
                        <input type="email" class="form-control"
                            value="{{$users->email }}" name="email"
                            id="email" placeholder="Email">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="name">Nama</label>
                        <input type="text" class="form-control"
                            value="{{auth()->user()->nama}}" name="nama"
                            id="nama" placeholder="Nama">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>
   

            </div>
        </div>



        <div class="form-button-group transparent">
            <button type="submit" class="btn btn-primary btn-block btn-lg">Simpan</button>
        </div>

    </form>
</div>

@endsection

@push('js')

@endpush