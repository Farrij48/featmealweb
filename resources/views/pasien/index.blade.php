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
                <a href="{{ route('pasien.create') }}" class="btn btn-success">Tambah</a>
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
                            <td><img src="{{ asset('uploads/'.$row->avatar) }}" width="70px" class="thumbnail" /></td>
                            <td>{{ $row->status}}</td>
                            <td>-</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $pasien->links() }}
            </div>
        </div>
    </div>
</div>
@endsection