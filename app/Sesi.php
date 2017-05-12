<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{

    protected $table = 'sesi';
    protected $fillable = [
        'id','hari','sesi','created_at','updated_at','deleted_at',
            'updated_by',
            'deleted_by',
    ];
}
