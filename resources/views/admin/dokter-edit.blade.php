@extends('layouts.main')

@section('content')
<br>
<h5 class="fw-semibold">
    <a href="{{url('admin/dokter')}}"><i class="ti ti-arrow-left bg-danger rounded-circle text-white"></i>Kembali</a>
    Edit Dokter
</h5>

<div class="card">
    <div class="card-body">
        <form action="{{url('admin/dokter/update',$id)}}" method="post" enctype="multipart/form-data">
            @csrf

             <div class="form-group">
                <label for="" class="form-label">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{$data->nama}}">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$data->email}}">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
            </div> 
            <div class="form-group">
                <label for="" class="form-label">Spesialis</label>
                <input type="text" class="form-control @error('spesialis') is-invalid @enderror" name="spesialis" value="{{$data->spesialis}}">
            </div> 

            <div class="form-group">
    <label for="" class="form-label">Poli</label>
    <select name="poli_id" class="form-control">
        @foreach($poli as $v)
            <option value="{{ $v->id }}" {{ $v->id == $data->poli_id ? 'selected' : '' }}>{{ $v->nama_poli }}</option>
        @endforeach
    </select>
</div>


            <div class="form-group">
                <label for="" class="form-label">Hari Praktik</label>
                <select name="hari_praktik" class="form-control">
                    <option value="senin" {{ $data->hari_praktik == 'senin' ? 'selected' : '' }}>Senin</option>
                    <option value="selasa" {{ $data->hari_praktik == 'selasa' ? 'selected' : '' }}>Selasa</option>
                    <option value="rabu" {{ $data->hari_praktik == 'rabu' ? 'selected' : '' }}>Rabu</option>
                    <option value="kamis" {{ $data->hari_praktik == 'kamis' ? 'selected' : '' }}>Kamis</option>
                    <option value="jumat" {{ $data->hari_praktik == 'jumat' ? 'selected' : '' }}>Jumat</option>
                    <option value="sabtu" {{ $data->hari_praktik == 'sabtu' ? 'selected' : '' }}>Sabtu</option>
                    <option value="minggu" {{ $data->hari_praktik == 'minggu' ? 'selected' : '' }}>Minggu</option>
                </select>

            </div>
            <div class="form-group">
                <label for="" class="form-label">Jam Praktik</label>
                <input type="time" class="form-control @error('jam_praktik') is-invalid @enderror" name="jam_praktik"value="{{$data->jam_praktik}}">
            </div>



            <button type="submit" class="btn btn-success float-end mt-3">Update</button>

        </form>
    </div>
</div>

@endsection

@push('js')

@endpush