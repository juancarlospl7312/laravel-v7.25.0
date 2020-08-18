<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Relación Many to Many
    public function news(){
        return $this->belongsToMany(News::class)->withTimestamps();
    }
}
