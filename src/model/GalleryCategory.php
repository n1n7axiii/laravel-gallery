<?php namespace N1n7aXIII\Gallery\Model;

use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model {

    public function items()
    {
        return $this->hasMany('N1n7aXIII\Gallery\Model\GalleryItem', 'category_id');
    }

    public function imageUrl()
    {
        return asset(config('gallery.gallery_asset_url').'/'.$this->id.'/');
    }

}
