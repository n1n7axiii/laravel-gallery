@extends('layouts.master-admin')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ $category->name }}
            <div class="floatR"><a href="{{ route('admin.gallery.item.create', $category->id) }}"><i class="fa fa-plus"></i> Add Item</a></div>
        </div>
        @if ($category->items()->count())
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <th width="30%">Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        @if (config('gallery.item_highlight'))<th class="text-center">Highlight</th>@endif
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category->items as $item)
                        <tr>
                            <td><img src="{{ $category->imageUrl().'/'.$item->thumbnail() }}" alt=""></td>
                            <td>{{ $item->title }}</td>
                            <td>{{ str_limit($item->description) }}</td>
                            @if (config('gallery.item_highlight'))<td class="text-center">@if($item->highlight)<p class="text-success"><i class="fa fa-check"></i></p>@endif</td>@endif
                            <td class="text-right">
                                <a href="{{ route('admin.gallery.item.edit', [$category->id, $item->id]) }}"><i class="fa fa-pencil-square"></i></a>
                                <a href="{{ route('admin.gallery.item.destroy', [$category->id, $item->id]) }}" class="btn-destroy" data-confirm="Are you want to delete the item?" data-token="{{ csrf_token() }}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="panel-body">
                This category didn't have any item.
            </div>
        @endif
    </div>
</div>
@stop