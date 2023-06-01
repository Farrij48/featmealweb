@extends('layouts.bootstrap')
@section('title')
Resep Page
@endsection
@section('content')
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AdminLTE 3 | User Profile</title>

    <!-- Google Font: Source Sans Pro -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
    />
    <!-- Font Awesome -->
    <link href="{{ asset('desain/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" >
    
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('desain/dist/css/adminlte.min.css') }}" type="text/css" >

  </head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Navbar -->

      <!-- Main Sidebar Container -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                    <div class="text-center">
                    @if($user->avatar)
                      <img
                        class="img-thumbnail rounded mx-auto d-block"
                        alt="User profile picture"
                        src="{{ asset('avatar/'.$user->avatar) }}">
                    @else
                      <img 
                      src="{{ asset('img/profile.jpg') }}" 
                      class="img-thumbnail rounded mx-auto d-block">
                    @endif  
                    
                    </div>

                    <h3 class="profile-username text-center">{{ $user->name }}</h3>

                    <p class="text-muted text-center">{{ $user->level }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Gender</b> <a class="float-right">{{ $user->gender }}</a>
                      </li>
                      <li class="list-group-item">
                        <b>Telepon</b> <a class="float-right">{{ $user->phone }}</a>
                      </li>
                      <li class="list-group-item">
                        <b>NIK</b> <a class="float-right">{{ $user->nik }}</a>
                      </li>
                    </ul>

                    <a href="#" class="btn btn-primary btn-block"
                      ><b>Twitter</b></a
                    >
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <div class="card">
                  <div class="card-header p-2">
                    <ul class="nav nav-pills">
                      <li class="nav-item">
                      <li class="nav-item"><a class="nav-link" href="#timeline"
                                                data-toggle="tab">Timeline</a></li>
                        <a class="nav-link" href="#settings" data-toggle="tab"
                          >Settings</a
                        >
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="active tab-pane" id="activity">
                      </div>

                      <!-- UPDATE FORM PROFILE -->
                      <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                      @method('PATCH')
                      @csrf
  

                        <div class="form-group row">
                            <label
                              for="name"
                              class="col-sm-2 col-form-label"
                              >{{ __('Name') }}</label>
                            <div class="col-sm-10">
                              <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                value="{{ $user->name }}"/>
                                </div>
                          </div>

                          <div class="form-group row">
                            <label
                              for="email"
                              class="col-sm-2 col-form-label"
                              >{{ __('Email') }}</label>
                            <div class="col-sm-10">
                              <input
                                type="text"
                                class="form-control"
                                id="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"/>
                                </div>
                                </div>

                                <div class="form-group row">
                                           <label for="level" class="col-sm-2 col-form-label" >{{ __('Jabatan') }}</label>
                                <div class="col-sm-10">
                                          <select name="level" id="level" class="form-control">
                                           <option >{{ $user->level }}</option>
                                           <option value="admin">Ahli Gizi</option>
                                           <option value="chef">Chef</option>
                                           
                                        </select>
                                        <span class="error invalid-feedback">{{$errors->first('level') }}</span>
                                        </div>
                                        </div>
                                </div>

                                <div class="form-group row">
                                           <label for="gender" class="col-sm-2 col-form-label" >{{ __('Gender') }}</label>
                                <div class="col-sm-10">
                                          <select name="gender" id="gender" class="form-control">
                                           <option >{{ $user->gender }}</option>
                                           <option value="pria">Pria</option>
                                           <option value="wanita">Wanita</option>
                                           
                                        </select>
                                        <span class="error invalid-feedback">{{$errors->first('level') }}</span>
                                        </div>
                                        </div>

                            <div class="form-group row">
                            <label
                              for="phone"
                              class="col-sm-2 col-form-label"
                              >{{ __('Telepon') }}</label>
                            <div class="col-sm-10">
                              <input
                                type="text"
                                class="form-control"
                                id="phone"
                                name="phone"
                                value="{{ $user->phone }}"
                                />
                                </div>
                                </div>

                                <div class="form-group row">
                            <label
                              for="nik"
                              class="col-sm-2 col-form-label"
                              >{{ __('NIK') }}</label>
                            <div class="col-sm-10">
                              <input
                                type="text"
                                class="form-control"
                                id="nik"
                                name="nik"
                                value="{{ $user->nik }}"
                                />
                                </div>
                                </div>

                                <div class="form-group row">
                            <label
                              for="address"
                              class="col-sm-2 col-form-label"
                              >{{ __('Address') }}</label>
                            <div class="col-sm-10">
                              <input
                                type="text"
                                class="form-control"
                                id="address"
                                name="address"
                                value="{{ $user->address }}"
                                />
                                </div>
                                </div>
                                

                                <div class="form-group row">
                            <label
                              for="old_password"
                              class="col-sm-2 col-form-label"
                              >{{ __('Old Password') }}</label>
                            <div class="col-sm-10">
                              <input
                                type="password"
                                class="form-control"
                                id="old_password"
                                name="old_password"
                                />
                                </div>
                                </div>

                                <div class="form-group row">
                            <label
                              for="password"
                              class="col-sm-2 col-form-label"
                              >{{ __('New Password') }}</label>
                            <div class="col-sm-10">
                              <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password" autocomplete="new-password"
                                />
                                </div>
                                </div>

                                <div class="form-group row">
                            <label
                              for="password"
                              class="col-sm-2 col-form-label"
                              >{{ __('Confirm Pass') }}</label>
                            <div class="col-sm-10">
                              <input
                                type="password"
                                class="form-control"
                                id="password-confirm"
                                name="password_confirmation" autocomplete="new-password"
                                />
                                </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password-confirm" class="col-sm-2 col-form-label">{{ __('Avatar') }}</label>

                                    <div class="col-sm-10">
                                        <input id="avatar" type="file" class="form-control" name="avatar"/>
                                    </div>
                                </div>

                      
                          
                            
                          
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <button type="submit" class="btn btn-danger">
                                Submit
                              </button>
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- /.tab-pane -->
                      
                    </div>
                    <!-- /.tab-content -->
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        
      </div>
      <!-- /.content-wrapper -->
      

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('desain/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('desain/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('desain/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('desain/dist/js/demo.js') }}"></script>
  </body>
</html>

@endsection