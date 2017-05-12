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

    public function prodis() {
      $this->belongsToMany('App\Prodi');
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
