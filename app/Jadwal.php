<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $fillable = [
        'id','user_id','sesi_prodi_id','sesi_prodi_id_selesai','makul_id','keyword','kelas','ruangan','pengingat','created_at','updated_at','deleted_at',
            'updated_by',
            'deleted_by',
    ];
}
