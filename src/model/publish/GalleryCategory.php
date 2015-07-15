<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model {

    public function items()
    {
        return $this->hasMany('App\GalleryItem', 'category_id');
    }

    public function imageUrl()
    {
        return asset(config('gallery.gallery_asset_url').'/'.$this->id.'/');
    }

}
