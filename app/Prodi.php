<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    //
    protected $table = 'prodi';
    protected $fillable = [
        'id','fakultas_id','nama','created_at','updated_at','deleted_at',
            'created_by',
            'updated_by',
            'deleted_by',
    ];

    public function fakultas() {
      return $this->belongsTo('App\Fakultas', 'fakultas_id');
    }

    public function sesis() {
      return $this->belongsToMany('App\Sesi');
    }

    public function user() {
      return $this->hasMany('App\User', 'prodi_id');
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
