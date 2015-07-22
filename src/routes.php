<?php

/*
 * todo
 * the middleware auth.admin is from another dependent package.
 * the javascript and layouts.master-admin is also from another dependent package.
 */

Route::bind('n1n7a_gallery_category', function ($value)
{
    return \N1n7aXIII\Gallery\Models\GalleryCategory::where('alias', $value)->orWhere('id', $value)->first();
});

/* For Admin */
Route::group(['prefix' => config('gallery.admin_path'), 'namespace' => 'N1n7aXIII\Gallery', 'middleware' => 'auth.admin'], function ()
{
    Route::get('/gallery', ['as' => 'admin.gallery.index', 'uses' => 'GalleryAdminCategoryController@index']);
    Route::get('/gallery/category/create', ['as' => 'admin.gallery.category.create', 'uses' => 'GalleryAdminCategoryController@create']);
    Route::post('/gallery/category/store/{n1n7a_gallery_category}', ['as' => 'admin.gallery.category.store', 'uses' => 'GalleryAdminCategoryController@store']);
    Route::get('/gallery/category/show/{n1n7a_gallery_category}', ['as' => 'admin.gallery.category.show', 'uses' => 'GalleryAdminCategoryController@show']);
    Route::get('/gallery/category/edit/{n1n7a_gallery_category}', ['as' => 'admin.gallery.category.edit', 'uses' => 'GalleryAdminCategoryController@edit']);
    Route::put('/gallery/category/update/{n1n7a_gallery_category}', ['as' => 'admin.gallery.category.update', 'uses' => 'GalleryAdminCategoryController@update']);
    Route::delete('/gallery/category/destroy/{n1n7a_gallery_category}', ['as' => 'admin.gallery.category.destroy', 'uses' => 'GalleryAdminCategoryController@destroy']);

    Route::get('/gallery/{n1n7a_gallery_category}/item', ['as' => 'admin.gallery.item.create', 'uses' => 'GalleryAdminItemController@create']);
    Route::post('/gallery/{n1n7a_gallery_category}/item', ['as' => 'admin.gallery.item.store', 'uses' => 'GalleryAdminItemController@store']);
    Route::get('/gallery/{n1n7a_gallery_category}/item/{id}', ['as' => 'admin.gallery.item.edit', 'uses' => 'GalleryAdminItemController@edit']);
    Route::put('/gallery/{n1n7a_gallery_category}/item/{id}', ['as' => 'admin.gallery.item.update', 'uses' => 'GalleryAdminItemController@update']);
    Route::delete('/gallery/{n1n7a_gallery_category}/item/{id}', ['as' => 'admin.gallery.item.destroy', 'uses' => 'GalleryAdminItemController@destroy']);
});