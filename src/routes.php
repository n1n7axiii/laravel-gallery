<?php

/*
 * todo
 * the middleware auth.admin is from another dependent package.
 * the javascript and layouts.master-admin is also from another dependent package.
 */

Route::bind('category', function ($value)
{
    return \N1n7aXIII\Gallery\Model\GalleryCategory::where('alias', $value)->orWhere('id', $value)->first();
});

/* For Admin */
Route::group(['prefix' => config('gallery.admin_path'), 'namespace' => 'N1n7aXIII\Gallery', 'middleware' => 'auth.admin'], function ()
{
    Route::resource('gallery', 'GalleryAdminCategoryController', ['names' => [
        'index' => 'admin.gallery.index',
        'create' => 'admin.gallery.category.create',
        'store' => 'admin.gallery.category.store',
        'show' => 'admin.gallery.category.show',
        'edit' => 'admin.gallery.category.edit',
        'update' => 'admin.gallery.category.update',
        'destroy' => 'admin.gallery.category.destroy',
    ]]);
    Route::resource('gallery/{category}/item', 'GalleryAdminItemController', ['except' => ['index'], 'names' => [
        'create' => 'admin.gallery.item.create',
        'store' => 'admin.gallery.item.store',
        'edit' => 'admin.gallery.item.edit',
        'update' => 'admin.gallery.item.update',
        'destroy' => 'admin.gallery.item.destroy',
    ]]);
});