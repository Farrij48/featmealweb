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
                <h3>{{$countp}}</h3>
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
                <h3>{{ $countr }}</h3>
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
    

    
    @if(Auth::user()->level=="admin")
    <div class="row">
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3>Pasien Data</h3>
            </div>
            <div class="card-body table-responsive">
                

                
                <!-- <a href="" class="btn btn-primary">Back</a>
               
                <a href="" class="btn btn-success">Tambah</a> -->
                

                <hr />
                <form action="" method="get">
                    <div class="row">
                        <div class="col-2">
                            <b>Cari Nama</b>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" value="" id="keyword"
                                name="keyword" />
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <hr />
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Gejala</th>
                            <th>Diagnosis</th>
                            <th>BB</th>
                            <th>TB</th>
                            <th>Usia</th>
                            <th>Avatar</th>
                            <th>Status</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($pasien as $row)
                        <tr>
                        <td>{{ $loop->iteration + ($pasien->perPage() * ($pasien->currentPage() -1) ) }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->gender }}</td>
                            <td>{{ $row->phone }}</td>
                            <td>{{ $row->gejala }}</td>
                            <td>{{ $row->diagnosis }}</td>
                            <td>{{ $row->berat_badan }}</td>
                            <td>{{ $row->tinggi_badan }}</td>
                            <td>{{ $row->usia }}</td>
                            <td><img src="{{ asset('public/uploads/'.$row->avatar) }}" width="70px" class="thumbnail" /></td>
                            <td>{{ $row->status}}</td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
       
            <div class="card-footer">
            {{ $pasien->appends(Request::all())->links() }}
            </div>
        </div>
    </div>
</div>
            
            @endif


            @if(Auth::user()->level=="chef")
            <div class="row">
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3>Module Data Resep</h3>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category</th>
                            <th>Chef</th>
                            <th>Title</th>
                            <th>Thumbnail</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($resep as $row)
                        <tr>
                        <td>{{ $loop->iteration + ($resep->perPage() * ($resep->currentPage() -1) ) }}</td>
                            <td>{{ $row->category->name }}</td>
                            <td>{{ $row->user->name }}</td>
                            <td>{{ $row->title }}</td>
                            <td>
                                <img src="{{ asset('public/uploads/'.$row->thumbnail) }}" class="img-thumbnail" width="150px">
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
            {{ $resep->links(); }}
            
                @endif
                </div>
        </div>
    </div>
</div>

           
                
                


</div>
@endsection

