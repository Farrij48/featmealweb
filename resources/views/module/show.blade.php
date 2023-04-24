@extends('layouts.bootstrap')
@section('title')
Detail Module
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Detail Module Resep - {{ $module->title }}</h3>
            </div>
            <div class="card-body table-responsive">
                <a href="{{ route('module.detail',[$module->resep_id]) }}" class="btn btn-info">Back</a>
                <hr />
                <table class="table table-bordered">
                    <tr>
                        <td>Title</td>
                        <td>:</td>
                        <td>{{ $module->title }}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>:</td>
                        <td>{!!$module->description!!}</td>
                    </tr>
                    <tr>
                        <td>Module Type</td>
                        <td>:</td>
                        <td>{{ $module->module_type }}
                            @if($module->module_type == "file")
                            / {{ $module->file_type }}
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>Module</td>
                        <td>:</td>
                        <td>
                            @if($module->module_type == "file")
                            <a class="btn btn-info btn-sm"
                                href="{{ route('module.download',[$module->id]) }}">Download</a>
                            @else
                            <iframe width="200" height="100" src="https://www.youtube.com/embed/{{ $module->youtube }}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>
@endsection