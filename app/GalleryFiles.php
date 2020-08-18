<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryFiles extends Model
{
    protected $table = 'gallery_files';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Relation One to One
    public function gallery() {
        return $this->hasOne(Gallery::class, 'id');
    }
}
