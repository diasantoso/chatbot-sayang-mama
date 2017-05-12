<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $table = 'fakultas';
    protected $fillable = [
        'id','nama','created_at','updated_at','deleted_at',
            'created_by',
            'updated_by',
            'deleted_by',
    ];

    public function prodis() {
      return $this->hasMany('App\Prodi', 'fakultas_id');
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
