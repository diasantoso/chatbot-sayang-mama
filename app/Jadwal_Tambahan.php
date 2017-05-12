<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal_Tambahan extends Model
{
    protected $table = 'jadwal_tambahan';
    protected $fillable = [
        'id','makul_id','name','deskripsi','waktu_mulai','waktu_selesai','type', 'keyword','created_at','updated_at','deleted_at',
            'created_by',
            'updated_by',
            'deleted_by',
    ];

    public function user() {
      return $this->belongsTo('App\User');
    }

    public function makul() {
      return $this->belongsTo('App\Makul', 'makul_id');
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
