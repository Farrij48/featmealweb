@extends('layouts.bootstrap')
@section('title')
Resep Page
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3>Data Resep</h3>
            </div>
            <div class="card-body table-responsive">
                @include('alert.success')
                @if(Request::get('keyword'))

                <a href="{{ route('resep.index') }}" class="btn btn-primary">Back</a>
                @else
                <a href="{{ route('resep.create') }}" class="btn btn-success">Tambah</a>
                <!-- @if (Auth::user()->level == 'chef')
                <a href="{{ route('resep.create') }}"></a>
                @endif -->
                @endif

                <!-- @if (Auth::user()->level == 'chef')
                <a href="{{ route('resep.create') }}">Tambah</a>
                @else
                <a href="{{ route('resep.create') }}" disabled>Tambah</a>
                @endif   -->

                <hr />

                <form method="get" action="{{ route('resep.index') }}">
                    <div class="row">
                        <div class="col-2">
                            <b>Search Resep</b>
                        </div>

                        <div class="col-6">
                            <input type="text" class="form-control" value="{{ Request::get('keyword') }}" id="keyword"
                                name="keyword">
                        </div>

                        <div class="col-1">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                        <div class="col-3">
                            <a class="btn bg-gradient-success" href="{{ route('resep.index') }}">Published</a>
                            <a class="btn btn-outline-success" href="{{ route('resep.trash') }}">Trash</a>
                        </div>
                    </div>
                </form>


                <hr />
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
                            <td>{{ $row->category->name ?? 'None' }}</td>
                            <td>{{ $row->user->name  ?? 'None'}}</td>
                            <td>{{ $row->title }}</td>
                            <td>
                                <img src="{{ asset('uploads/'.$row->thumbnail) }}" width="100px" class="img-thumbnail">
                            </td>
                            <td>
                                <a href="{{ route('resep.edit',[$row->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form class="d-inline" action="{{ route('resep.destroy',[$row->id]) }}" method="post"
                                    onsubmit="return confirm ('Hapus Resep Ke Trash ?')">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <input type="submit" class="btn btn-danger btn-sm" value="Trash">
                                </form>
                                <a href="{{ route('resep.show',[$row->id]) }}" class="btn btn-primary btn-sm">Show</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $resep->appends(Request::all())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection