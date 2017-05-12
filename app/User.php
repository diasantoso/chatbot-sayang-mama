<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
class User extends Authenticatable
{
	 use Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'id','chat_log_line_id','fullname','npm','email','role','password','lupa_pass','status','image','prodi_id','registerdate','created_at','updated_at','deleted_at',
						'updated_by',
            'deleted_by',
    ];
     protected $hidden = [
        'email', 'password',
    ];

		public function chatLog() {
			return $this->hasOne('App\Chat_Log_line');
		}

		public function prodi() {
			return $this->belongsTo('App\Prodi');
		}

		public function jadwal() {
			return $this->hasMany('App\Jadwal');
		}

		public function jadwalTambahan() {
			return $this->hasMany('App\Jadwal_Tambahan');
		}

		/* --------------- Sesi --------------- */
    public function sesiCreate() {
        return $this->hasMany('App\Sesi', 'created_by');
    }
    public function sesiUpdate() {
        return $this->hasMany('App\Sesi', 'updated_by');
    }
    public function sesiDelete() {
        return $this->hasMany('App\Sesi', 'deleted_by');
    }
    /* --------------- Sesi --------------- */

		/* --------------- Prodi --------------- */
    public function prodiCreate() {
        return $this->hasMany('App\Prodi', 'created_by');
    }
    public function prodiUpdate() {
        return $this->hasMany('App\Prodi', 'updated_by');
    }
    public function prodiDelete() {
        return $this->hasMany('App\Prodi', 'deleted_by');
    }
    /* --------------- Prodi --------------- */

		/* --------------- Makul --------------- */
    public function makulCreate() {
        return $this->hasMany('App\Makul', 'created_by');
    }
    public function makulUpdate() {
        return $this->hasMany('App\Makul', 'updated_by');
    }
    public function makulDelete() {
        return $this->hasMany('App\Makul', 'deleted_by');
    }
    /* --------------- Makul --------------- */

		/* --------------- Jadwal --------------- */
    public function jadwalCreate() {
        return $this->hasMany('App\Jadwal', 'created_by');
    }
    public function jadwalUpdate() {
        return $this->hasMany('App\Jadwal', 'updated_by');
    }
    public function jadwalDelete() {
        return $this->hasMany('App\Jadwal', 'deleted_by');
    }
    /* --------------- Jadwal --------------- */

		/* --------------- Jadwal Tambahan --------------- */
    public function jadwalTambahanCreate() {
        return $this->hasMany('App\Jadwal_Tambahan', 'created_by');
    }
    public function jadwalTambahanUpdate() {
        return $this->hasMany('App\Jadwal_Tambahan', 'updated_by');
    }
    public function jadwalTambahanDelete() {
        return $this->hasMany('App\Jadwal_Tambahan', 'deleted_by');
    }
    /* --------------- Jadwal Tambahan --------------- */

		/* --------------- Fakultas --------------- */
    public function fakultasCreate() {
        return $this->hasMany('App\Fakultas', 'created_by');
    }
    public function fakultasUpdate() {
        return $this->hasMany('App\Fakultas', 'updated_by');
    }
    public function fakultasDelete() {
        return $this->hasMany('App\Fakultas', 'deleted_by');
    }
    /* --------------- Fakultas --------------- */

		/* --------------- Chat Log Line --------------- */
    public function chatLogCreate() {
        return $this->hasMany('App\Chat_Log_line', 'created_by');
    }
    public function chatLogUpdate() {
        return $this->hasMany('App\Chat_Log_line', 'updated_by');
    }
    public function chatLogDelete() {
        return $this->hasMany('App\Chat_Log_line', 'deleted_by');
    }
    /* --------------- Chat Log Line --------------- */
}
