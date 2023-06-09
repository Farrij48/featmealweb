@extends('layouts.bootstrap')
@section('title')
Trash Category
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3>Trashed Category</h3>
            </div>
            <div class="card-body table-responsive">
                <div class="row">
                    <div class="col-3">
                        <a class="btn btn-outline-success" href="{{ route ('category.index') }}">Published</a>
                        <a class="btn bg-gradient-success" href="{{ route ('category.trash') }}">Trash</a>
                    </div>
                </div>
                <hr />
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Thumbnail</th>
                            <th>Action</th>
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
                                <img alt="" class="img-thumbnail" src="{{ asset('uploads/'.$row->thumbnail) }}"
                                    width="150px">
                            </td>
                            <td>
                                <a href="{{ route('category.restore',[$row->id]) }}"
                                    class="btn btn-success btn-sm">Restore</a>
                                <form class="d-inline" action="{{route ('category.delete-permanent',[$row->id]) }}"
                                    method="post" onsubmit="return confirm('Hapus Category Permanen ?')">
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
                {{ $category->links() }}
            </div>
        </div>
    </div>
</div>
@endsection