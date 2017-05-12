<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Makul extends Model
{
    protected $table = 'makul';
    protected $fillable = [
        'id','nama','created_at','updated_at','deleted_at',
            'updated_by',
            'deleted_by',
    ];
}
