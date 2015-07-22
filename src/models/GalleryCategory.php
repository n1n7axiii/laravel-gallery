<?php namespace N1n7aXIII\Gallery\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model {

    public function items()
    {
        return $this->hasMany('N1n7aXIII\Gallery\Models\GalleryItem', 'category_id');
    }

    public function imageUrl()
    {
        return asset(config('gallery.gallery_asset_url').'/'.$this->id.'/');
    }

}
