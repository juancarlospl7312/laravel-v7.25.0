<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'page';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Relation One to One
    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id')->first();
    }

}
