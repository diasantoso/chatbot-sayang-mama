<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $fillable = [
        'id','user_id','sesi_prodi_id','sesi_prodi_id_selesai','makul_id','keyword','kelas','ruangan','pengingat','created_at','updated_at','deleted_at',
            'created_by',
            'updated_by',
            'deleted_by',
    ];

    public function user() {
      return $this->belongsTo('App\User');
    }

    public function sesi() {
      return $this->belongsTo('App\SesiProdi', 'sesi_prodi_id');
    }

    public function sesiSelesai() {
      return $this->belongsTo('App\SesiProdi', 'sesi_prodi_id_selesai');
    }

    public function makul() {
      return $this->belongsTo('App\Makul');
    }

    public function createdBy() {
      $this->belongsTo('App\User', 'created_by');
    }
    public function updatedBy() {
      $this->belongsTo('App\User', 'updated_by');
    }
    public function deletedBy() {
      $this->belongsTo('App\User', 'deleted_by');
    }
}
