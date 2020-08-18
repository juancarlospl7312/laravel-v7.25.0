<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translations extends Model
{
    protected $table = 'translations';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
