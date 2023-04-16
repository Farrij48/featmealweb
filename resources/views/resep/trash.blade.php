@extends('layouts.bootstrap')
@section('title')
Trash Page
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3>Trash Resep</h3>
            </div>
            <div class="card-body table-responsive">
                <div class="row">
                    <div class="col-3">
                        <a class="btn btn-outline-success" href="{{ route('resep.index') }}">Published</a>
                        <a class="btn bg-gradient-success" href="{{ route('resep.trash') }}">Trash</a>
                    </div>
                </div>
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
                            <td>{{ $row->category->name }}</td>
                            <td>{{ $row->user->name }}</td>
                            <td>{{ $row->title }}</td>
                            <td>
                                <img src="{{ asset('uploads/'.$row->thumbnail) }}" width="100px" class="img-thumbnail">
                            </td>
                            <td>
                                <a href="{{ route('resep.restore',[$row->id]) }}" class="btn btn-success sm">Restore</a>
                                <form class="d-inline" action="{{ route('resep.delete-permanent',[$row->id]) }}"
                                    method="post" onsubmit="return confirm('Hapus Resep Ini ?')">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <input type="submit" class="btn btn-danger" value="Hapus">
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $resep->links() }}
            </div>
        </div>
    </div>
</div>
@endsection