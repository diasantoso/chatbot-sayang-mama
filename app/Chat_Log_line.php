<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat_Log_line extends Model
{
    protected $table = 'chat_log_line';
    protected $fillable = [
        'id','user_id','chat_id','display_name','created_at','updated_at','deleted_at',
            'created_by',
            'updated_by',
            'deleted_by',
    ];

    public function user() {
      return $this->belongsTo('App\User');
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
