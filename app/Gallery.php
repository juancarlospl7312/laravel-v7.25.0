<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Relation One to Many
    public function galleryFiles()
    {
        return $this->hasMany(GalleryFiles::class)->get();
    }

    // Relation One to Many
    public function news()
    {
        return $this->hasMany(News::class)->get();
    }
}
