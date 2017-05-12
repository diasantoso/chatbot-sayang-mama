<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    protected $table = 'sesi';
    protected $fillable = [
        'id','hari','sesi', 'waktu', 'created_at','updated_at','deleted_at',
            'created_by',
            'updated_by',
            'deleted_by',
    ];

    public function jadwalMulai() {
      return $this->hasMany('App\Jadwal','sesi_mulai');
    }

    public function jadwalSelesai() {
      return $this->hasMany('App\Jadwal', 'sesi_selesai');
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
