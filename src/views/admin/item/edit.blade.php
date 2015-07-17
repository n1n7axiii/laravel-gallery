@extends('layouts.master-admin')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Edit Item {{ $item->title }}</div>
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

            {!! Form::model($item, ['class' => 'form-horizontal', 'files' => 'true', 'method' => 'PATCH', 'url' => route('admin.gallery.item.update', [$category->id, $item->id])]) !!}
                <div class="form-group">
                    <label class="col-md-4 control-label">Title</label>
                    <div class="col-md-6">
                        {!! Form::text('title', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Image</label>
                    <div class="col-md-6">
                        <img src="{{ $category->imageUrl().'/'.$item->thumbnail() }}" alt="">
                        <br><br>
                        {!! Form::file('image') !!}
                        <p class="help-block">Best Size {{ config('gallery.item_max_width') }} x {{ config('gallery.item_max_height') }} px</p>
                    </div>
                </div>

                @if (config('gallery.item_highlight'))
                    <div class="form-group">
                        <div class="col-md-4">&nbsp;</div>
                        <div class="col-md-6">
                            <label>
                                {!! Form::checkbox('highlight', '1', false, ['style' => 'vertical-align:bottom;']) !!} Highlight
                            </label>
                        </div>
                    </div>
                @endif

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