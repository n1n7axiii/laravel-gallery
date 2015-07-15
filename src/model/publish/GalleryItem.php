<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model {

    public function category()
    {
        return $this->belongsTo('App\GalleryCategory', 'category_id');
    }

    public function thumbnail()
    {
        $image_info = pathinfo($this->image);
        return $image_info['filename'].'-thumb.'.$image_info['extension'];
    }

}
