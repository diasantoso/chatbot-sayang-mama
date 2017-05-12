<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal_Tambahan extends Model
{
    protected $table = 'jadwal_tambahan';
    protected $fillable = [
        'id','makul_id','name','deskripsi','waktu_mulai','waktu_selesai','type','created_at','updated_at','deleted_at',
            'created_by',
            'updated_by',
            'deleted_by',
    ];

    public function makul() {
      $this->belongsTo('App\Makul', 'makul_id');
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
