<?php

return [

    /*
    | File system paths.
    |
    | ex. www.your-domain.com/backadmin/gallery
    */

    'admin_path' => 'backadmin',

    // Use as real path to the file.
    'gallery_path' => storage_path('app/images/gallery/'),

    // This path will be use at GalleryCategory::imageUrl() in conjunction with asset() to generate the url to image folder.
    'gallery_asset_url' => 'storage/app/images/gallery',

    /*
    | Gallery's Category
    */

    'category_thumb' => true,

    'category_thumb_width' => 264,

    'category_thumb_height' => 142,

    /*
    | Gallery's Items
    */

    'item_highlight' => true,

    'item_thumb_width' => 264,

    'item_thumb_height' => 142,

    'item_max_width' => 1980,

    'item_max_height' => 1080

];