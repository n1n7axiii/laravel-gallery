@extends('layouts.master-admin')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">{{ $category->name }}</div>
        <div class="panel-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::model($category, ['class' => 'form-horizontal', 'files' => 'true', 'method' => 'PUT', 'url' => route('admin.gallery.category.update', $category->id)]) !!}
                @if (config('gallery.category_thumb'))
                    <div class="form-group">
                        <label class="col-md-4 control-label">Thumbnail</label>
                        <div class="col-md-6">
                            @if ($category->thumbnail)
                                <img src="{{ $category->imageUrl().'/'.$category->thumbnail }}" alt="">
                                <br><br>
                            @endif
                            {!! Form::file('thumbnail') !!}
                            <p class="help-block">Size {{ config('gallery.category_thumb_width') }}px x {{ config('gallery.category_thumb_height') }}px</p>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label class="col-md-4 control-label">Name</label>
                    <div class="col-md-6">
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Alias</label>
                    <div class="col-md-6">
                        {!! Form::text('alias', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Description</label>
                    <div class="col-md-6">
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '5']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                            Update
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop