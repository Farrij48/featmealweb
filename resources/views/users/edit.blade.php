@extends('layouts.bootstrap')
@section('title')
Edit User
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3>Edit Pengguna</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('users.update',[$users->id]) }}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('put') }}
                    <div class="card-body">

                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control " disabled id="email" placeholder="Enter email"
                                value="{{ $users->email }}">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password"
                                class="form-control {{$errors->first('password') ? 'is-invalid' : ''}}" name="password"
                                id="password" placeholder="Enter Password">
                            <span class="error invalid-feedback">{{$errors->first('password')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="email">Name</label>
                            <input type="text" class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}"
                                name="name" id="name" placeholder="Enter Name" value="{{ $users->name }}">
                            <span class="error invalid-feedback">{{$errors->first('name')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="level">Level</label>
                            <select name="level" id="level"
                                class="form-control {{$errors->first('level') ? 'is-invalid' : ''}}">
                                <option value="admin" @if($users->level == "admin") selected @endif >Ahli Gizi</option>
                                <option value="chef" @if($users->level == "chef") selected @endif>Chef</option>
                            </select>
                            <span class="error invalid-feedback">{{$errors->first('level')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender"
                                class="form-control {{$errors->first('gender') ? 'is-invalid' : ''}}">
                                <option value="pria" @if($users->gender == "pria") selected @endif>pria</option>
                                <option value="wanita" @if($users->gender == "wanita") selected @endif>Wanita</option>
                            </select>
                            <span class="error invalid-feedback">{{$errors->first('gender')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="phone" class="form-control {{$errors->first('phone') ? 'is-invalid' : ''}}"
                                name="phone" id="phone" placeholder="Enter Phone Number" value="{{ $users->phone }}">
                            <span class="error invalid-feedback">{{$errors->first('phone')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control {{$errors->first('address') ? 'is-invalid' : ''}}"
                                name="address" id="address">{{ $users->address}}</textarea>
                            <span class="error invalid-feedback">{{$errors->first('address')}}</span>
                        </div>


                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="nik" class="form-control {{$errors->first('nik') ? 'is-invalid' : ''}}"
                                name="nik" id="nik" placeholder="Enter NIK Number" value="{{ $users->nik }}">
                            <span class="error invalid-feedback">{{$errors->first('nik')}}</span>
                        </div>


                        <div class="form-group">
                            <label for="avatar">Avatar</label>
                            <input type="file" class="form-control {{$errors->first('avatar') ? 'is-invalid' : ''}}"
                                name="avatar" id="avatar">
                            <span class="error invalid-feedback">{{$errors->first('avatar')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="avatar">Avatar</label>
                            <div class="input-group">
                                <img class="img-thumbnail" src="{{ asset('public/uploads/'.$users->avatar) }}" width="150px">
                            </div>
                        </div>


                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection