<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    //
    protected $table = 'prodi';
    protected $fillable = [
        'id','fakultas_id','nama','created_at','updated_at','deleted_at',
            'updated_by',
            'deleted_by',
    ];
}
