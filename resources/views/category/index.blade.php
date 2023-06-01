@extends('layouts.bootstrap')
@section('title')
Category Page
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3>Category Data</h3>
            </div>
            <div class="card-body table-responsive">
                @include('alert.success')
                @if(Auth::user()->level == "admin")
                <a href="{{ route('category.create') }}" class="btn btn-success">Tambah</a>
                @endif
                <hr>
                <div class="row">
                    <div class="col-3">
                        <!-- <a class="btn bg-gradient-success" href="{{ route ('category.index') }}">Published</a>
                        <a class="btn btn-outline-success" href="{{ route ('category.trash') }}">Trash</a> -->
                    </div>
                </div>

                <hr />
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Thumbnail</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category as $row)
                        <tr>
                            <td>
                                {{ $loop->iteration + ($category->perPage() * ($category->currentPage() -1) ) }}
                            </td>
                            <td>
                                {{ $row-> name }}
                            </td>
                            <td>
                                <img alt="" class="img-thumbnail" src="{{ asset('public/uploads/'.$row->thumbnail) }}"
                                    width="150px">
                            </td>
                            <td>
                                @if(Auth::user()->level == "admin")
                                <a href="{{ route ('category.edit',[$row->id]) }}" class="btn btn-info btn-sm">Edit</a>
                                <form action="{{ route('category.destroy',[$row->id]) }}" method="post"
                                    onsubmit="return confirm('Move Category To Trash')" class="d-inline">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <input type="submit" class="btn btn-danger btn-sm" value="Trash">
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $category->links() }}
            </div>
        </div>
    </div>
</div>
@endsection