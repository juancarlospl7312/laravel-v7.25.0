<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Relation One to Many
    public function users()
    {
        return $this->hasMany(Role::class);
    }
}
