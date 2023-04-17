@extends('layouts.bootstrap')

@section('title')
Halaman Detail Resep
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Module Detail Resep</h3>
                <h4>Chef - {{ Auth::user()->name }}</h4>
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
                            <th>Action</th>
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
                                <img src="{{ asset('uploads/'.$row->thumbnail) }}" class="img-thumbnail" width="150px">
                            </td>
                            <th>
                                -
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $resep->links(); }}
            </div>
        </div>
    </div>
</div>
@endsection