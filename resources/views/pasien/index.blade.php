@extends('layouts.bootstrap')
@section('title')
Pasien Page
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3>Pasien Data</h3>
            </div>
            <div class="card-body table-responsive">
                @include('alert.success')

                @if(Request::get('keyword'))
                <a href="{{ route('pasien.index') }}" class="btn btn-primary">Back</a>
                @else
                <a href="{{ route('pasien.create') }}" class="btn btn-success">Tambah</a>
                @endif

                <hr />
                <form action="{{ route('pasien.index') }}" method="get">
                    <div class="row">
                        <div class="col-2">
                            <b>Cari Nama</b>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" value="{{ Request::get('keyword') }}" id="keyword"
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
                            <th>Action</th>
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
                            <td><img src="{{ asset('uploads/'.$row->avatar) }}" width="70px" class="thumbnail" /></td>
                            <td>{{ $row->status}}</td>
                            <td>
                                <a href="{{ route('pasien.edit',[$row->id]) }}" class="btn btn-info btn-sm">Edit</a>
                                <form method="post" class="d-inline"
                                    action="{{ route('pasien.resetpassword',[$row->id]) }}"
                                    onsubmit="return confirm('Ingin Mereset Passowrd ?')">
                                    @csrf
                                    <input type="submit" value="Reset" class="btn btn-success btn-sm" />
                                </form>
                                <form class="d-inline" action="{{ route('pasien.destroy',[$row->id]) }}" method="post"
                                    onsubmit="return confirm('Hapus Pasien Ini ?')">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <input type="submit" class="btn btn-danger btn-sm" value="Delete" />
                                </form>
                            </td>
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
@endsection