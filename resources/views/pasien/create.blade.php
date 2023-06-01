@extends('layouts.bootstrap')
@section('title')
Tambah Pasien
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3>Create Pasien</h3>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="post" action="{{ route('pasien.store') }}">
                    @csrf
                    <div class="card-body">

                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control {{$errors->first('email') ? 'is-invalid' : ''}}"
                                name="email" id="email" placeholder="Masukkan Email" value="{{ old('email') }}">
                            <span class="error invalid-feedback">{{$errors->first('email')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}"
                                name="name" id="name" placeholder="Masukkan Nama" value="{{ old('name') }}">
                            <span class="error invalid-feedback">{{$errors->first('name')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="pria">Pria</option>
                                <option value="wanita">Wanita</option>
                            </select>
                            <span class="error invalid-feedback">{{$errors->first('gender') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control {{$errors->first('phone') ? 'is-invalid' : ''}}"
                                name="phone" id="phone" placeholder="Masukkan No Telepon" value="{{ old('phone') }}">
                            <span class="error invalid-feedback">{{$errors->first('phone')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="nik" class="form-control {{$errors->first('nik') ? 'is-invalid' : ''}}"
                                name="nik" id="nik" placeholder="Masukkan No NIK" value="{{ old('nik') }}">
                            <span class="error invalid-feedback">{{$errors->first('nik')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control {{$errors->first('address') ? 'is-invalid' : ''}}"
                                name="address" placeholder="Masukkan Alamat" id="address">{{ old('address')}}</textarea>
                            <span class="error invalid-feedback">{{$errors->first('address')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="gejala">Gejala</label>
                            <textarea class="form-control {{$errors->first('gejala') ? 'is-invalid' : ''}}"
                                name="gejala" placeholder="Masukkan Gejala" id="gejala">{{ old('gejala') }}</textarea>
                            <span class="error invalid-feedback">{{$errors->first('gejala')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="diagnosis">Diagnosis</label>
                            <input type="text" class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}"
                                name="diagnosis" id="diagnosis" placeholder="Masukkan Diagnosis"
                                value="{{ old('diagnosis') }}">
                            <span class="error invalid-feedback">{{$errors->first('diagnosis')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="berat_badan">Berat Badan</label>
                            <input type="text"
                                class="form-control {{$errors->first('berat_badan') ? 'is-invalid' : ''}}"
                                name="berat_badan" id="berat_badan" placeholder="Masukkan Berat Badan"
                                value="{{ old('berat_badan') }}">
                            <span class="error invalid-feedback">{{$errors->first('berat_badan')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="tinggi_badan">Tinggi Badan</label>
                            <input type="text"
                                class="form-control {{$errors->first('tinggi_badan') ? 'is-invalid' : ''}}"
                                name="tinggi_badan" id="tinggi_badan" placeholder="Masukkan Tinggi Badan"
                                value="{{ old('tinggi_badan') }}">
                            <span class="error invalid-feedback">{{$errors->first('tinggi_badan')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="usia">usia</label>
                            <input type="text" class="form-control {{$errors->first('usia') ? 'is-invalid' : ''}}"
                                name="usia" id="usia" placeholder="Masukkan Usia Anda" value="{{ old('usia') }}">
                            <span class="error invalid-feedback">{{$errors->first('usia')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="avatar">Avatar</label>
                            <input type="file" class="form-control {{$errors->first('avatar') ? 'is-invalid' : ''}}"
                                name="avatar" id="avatar">
                            <span class="error invalid-feedback">{{$errors->first('avatar')}}</span>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection