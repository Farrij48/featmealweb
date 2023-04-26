@extends('layouts.bootstrap')
@section('title')
Module Page - {{ $resep->title }}
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3>Module Resep - {{ $resep->title }}</h3>
            </div>
            <div class="card-body table-responsive">
                @include('alert.success')
                <br />
                <a href="{{ route('module.create',[$resep_id]) }}" class="btn btn-success">Tambah</a>
                <hr />
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>File Type</th>
                            <th>Module</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($module as $row)
                        <tr>
                            <td>{{ $loop->iteration + ($module->perPage() * ($module->currentPage() -1) ) }}</td>
                            <td>{{ $row->title }}</td>
                            <td>{{ $row->module_type}}
                                @if($row->module_type == "file") / {{ $row->file_type}}
                                @endif
                            </td>
                            <td>
                                @if($row->module_type == "file")
                                <a href="{{ route('module.download',[$row->id]) }}"
                                    class="btn btn-info btn-sm">Download</a>
                                @else
                                <iframe width="200" height="100" src="https://www.youtube.com/embed/{{ $row->youtube }}"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('module.edit',[$row->id]) }}" class="btn btn-info btn-sm">Edit</a>
                                <a href="{{ route('module.show',[$row->id]) }}" class="btn btn-warning btn-sm">Show</a>
                                <form class="d-inline" action="{{ route('module.destroy',[$row->id]) }}" method="post"
                                    onsubmit="return confirm('Hapus item ini ?')">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $module->links(); }}
            </div>
        </div>
    </div>
</div>
@endsection