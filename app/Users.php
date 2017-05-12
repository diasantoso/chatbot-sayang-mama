<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
class Users extends Authenticatable
{
	 use Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'id','chat_log_line_id','chat_id','jangka_reminder','fullname','npm','email','role','password','lupa_pass','status','image','prodi_id','fakultas_id','registerdate','created_at','updated_at','deleted_at',
            'updated_by',
            'deleted_by',
    ];
     protected $hidden = [
        'email', 'password','role',
    ];
}
