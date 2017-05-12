<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal_Tambahan extends Model
{
    protected $table = 'jadwal_tambahan';
    protected $fillable = [
        'id','makul_id','name','deskripsi','waktu_mulai','waktu_selesai','type','created_at','updated_at','deleted_at',
            'updated_by',
            'deleted_by',
    ];
}
