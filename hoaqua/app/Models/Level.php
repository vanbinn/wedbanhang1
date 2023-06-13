<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $table = 'levels';
    protected $primarykey = 'id';

    public function users()
    {
        return $this->hasMany(User::class, 'id_level','id');
    }
     
}