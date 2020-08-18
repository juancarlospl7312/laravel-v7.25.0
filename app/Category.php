<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Relación Many to Many
    public function news(){
        return $this->belongsToMany(News::class)->withTimestamps();
    }

    // Relation One to Many
    public function page()
    {
        return $this->hasMany(Page::class)->get();
    }
}
