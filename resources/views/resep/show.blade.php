@extends('layouts.bootstrap')
@section('title')
Detail Resep - {{ $resep->title }}
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Detail Resep - {{ $resep->title }}</h3>
            </div>
            <div class="card-body table-responsive">
                <a href="{{ route('resep.index') }}" class="btn btn-info">Back</a>
                <hr />
                <table class="table table-bordered">
                    <tr>
                        <td>Title</td>
                        <td>:</td>
                        <td>{{ $resep->title }}</td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>:</td>
                        <td>{{ $resep->category->name }}</td>
                    </tr>
                    <tr>
                        <td>Chef</td>
                        <td>:</td>
                        <td>{{ $resep->user->name }}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>:</td>
                        <td>{{ $resep->description }}</td>
                    </tr>
                    <tr>
                        <td>Groub</td>
                        <td>:</td>
                        <td>{{ $resep->groub }}</td>
                    </tr>
                    <tr>
                        <td>Thumbnail</td>
                        <td>:</td>
                        <td><img src="{{ asset('uploads/'.$resep->thumbnail) }}" class="img-thumbnail" width="150"></td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Detail Module Resep - {{ $resep->title }}</h3>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Module Type</th>
                            <th>Module</th>
                            <th>View</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($module as $row)
                        <tr>
                            <td>{{ $row->title }}</td>
                            <td>{!! $row->description !!}</td>
                            <td>
                                {{ $row->module_type }}
                                @if($row->module_type == "file")
                                / {{ $row->file_type }}
                                @endif
                            </td>
                            <td>
                                @if($row->module_type == "file")
                                <a href="{{ route('resep.download',[$row->id]) }}"
                                    class="btn btn-info btn-sm">Download</a>
                                @else
                                <iframe width="200" height="100" src="https://www.youtube.com/embed/{{ $row->youtube }}"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                                @endif
                            </td>
                            <td>{{ $row->view }}</td>
                            <td>{{ $row->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>
@endsection