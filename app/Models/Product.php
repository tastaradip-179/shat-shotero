<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'type_id', 'code', 'title', 'description', 'sizes', 'colors', 'price', 'prev_price', 'stock', 'featured', 'status'];

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    public function featuredImage()
    {
        $image = $this->images()->where('type', 'featured')->first();
        if (!empty($image)) {
            return $image->url;
        }
        return '';
    }

    public function galleryImageFirst()
    {
        $image = $this->images()->where('type', 'gallery')->orderBy('id', 'ASC')->first();
        if (!empty($image)) {
            return $image->url;
        }
        return '';
    }

    public function galleryImages()
    {
        $gallery_images = $this->images()->where('type', 'gallery')->orderBy('id', 'ASC')->get();
        $gallery_images_count = $this->images()->where('type', 'gallery')->count();  
        if(!empty($gallery_images_count)){
            for($i=0; $i<$gallery_images_count; $i++){

            $data['product_gallery_images'][$i] = $gallery_images[$i];
        }
        return $data['product_gallery_images'];
        }
        else{
            return '';
        }
        
    }

    
}
