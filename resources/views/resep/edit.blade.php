@extends('layouts.bootstrap')
@section('title')
Update Resep
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3>Update Resep</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('resep.update',[$resep->id]) }}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="card-body">

                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach($category as $row)
                                <option value="{{ $row->id }}" @if($resep->category_id == $row->id) selected
                                    @endif>{{ $row->name }}</option>
                                @endforeach
                            </select>
                            <span class="error invalid-feedback">{{$errors->first('category_id')}}</span>
                        </div>


                        <div class="form-group">
                            <label for="user_id">Chef</label>
                            <select name="user_id" id="user_id" class="form-control">
                                @foreach($users as $row)
                                <option value="{{ $row->id }}" @if($resep->user_id == $row->id) selected
                                    @endif>{{ $row->name }}</option>
                                @endforeach
                            </select>
                            <span class="error invalid-feedback">{{$errors->first('user_id')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" value="{{ $resep->title }}"
                                class="form-control {{ $errors->first('title') ? 'is-invalid':'' }}" name="title"
                                id="title" />
                            <span class="error invalid-feedback">{{$errors->first('title')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description"
                                class="form-control {{ $errors->first('description') ? 'is-invalid':'' }}">
                                {{ $resep->description }}
                            </textarea>
                            <span class="error invalid-feedback">{{$errors->first('description')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="group">Group</label>
                            <input type="text" value="{{ $resep->group }}"
                                class="form-control {{ $errors->first('group') ? 'is-invalid':'' }}" name="group"
                                id="group" />
                            <span class="error invalid-feedback">{{$errors->first('group')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="kalori">Kalori</label>
                            <input type="text" value="{{ $resep->kalori }}"
                                class="form-control {{ $errors->first('kalori') ? 'is-invalid':'' }}" name="kalori"
                                id="kalori" />
                            <span class="error invalid-feedback">{{$errors->first('kalori')}}</span>
                        </div>


                        <div class="form-group">
                            <label for="thumbnail">Thumbnail</label>
                            <div class="input-group">
                                <img src="{{ asset('uploads/'.$resep->thumbnail) }}" width="150px">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="thumbnail"></label>
                            <input type="file" class="form-control {{  $errors->first('thumbnail') ? 'is-invalid':'' }}"
                                name="thumbnail" id="thumbnail">
                            <span class="error invalid-feedback">{{$errors->first('thumbnail')}}</span>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection