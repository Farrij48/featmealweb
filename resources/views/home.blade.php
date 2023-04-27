@extends('layouts.bootstrap')
@section('title')
Home
@endsection
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>



@section('content')
<div class="row">
    <div class="col-12">
        <h3>Dashboard</h3>
        <hr />
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $chef }}</h3>
                <p>Chef</p>
                <div class="icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $pasien }}</h3>
                <p>Pasien</p>
                <div class="icon">
                    <i class='bx bxs-user'></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $resep }}</h3>
                <p>Resep</p>
                <div class="icon">
                    <i class='bx bxs-notepad'></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $module }}</h3>
                <p>Module</p>
                <div class="icon">
                    <i class='bx bxs-movie-play'></i>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection