<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Makul extends Model
{
    protected $table = 'makul';
    protected $fillable = [
        'id','nama','created_at','updated_at','deleted_at',
            'created_by',
            'updated_by',
            'deleted_by',
    ];

    public function jadwalKuliah() {
      return $this->hasMany('App\Jadwal', 'makul_id');
    }

    public function jadwalTambahan() {
      return $this->hasMany('App\JadwalTambahan', 'makul_id');
    }

    public function createdBy() {
      return $this->belongsTo('App\User', 'created_by');
    }
    public function updatedBy() {
      return $this->belongsTo('App\User', 'updated_by');
    }
    public function deletedBy() {
      return $this->belongsTo('App\User', 'deleted_by');
    }
}
