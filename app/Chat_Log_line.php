<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat_Log_line extends Model
{
    protected $table = 'chat_log_line';
    protected $fillable = [
        'id','user_id','chat_id','display_name','created_at','updated_at','deleted_at',
            'updated_by',
            'deleted_by',
    ];
}
