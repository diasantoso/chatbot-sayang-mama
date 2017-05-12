<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Carbon\Carbon;

use App\User;
use App\Prodi;
use App\Fakultas;
use App\Jadwal;
use App\Makul;
use App\Sesi;

class JadwalController extends Controller
{
  public function index() {
    $userId = Auth::user()->id;
    $user = User::find($userId);
    $semuaJadwal = $user->jadwal;
    $semuaMakul=Makul::all();
    $semuaSesi=Sesi::all();


    return view("admin.jadwal", compact(
       'semuaJadwal','semuaMakul','semuaSesi'
     ));
  }

  public function checkJadwal($sesiID) {
    $userJadwal = User::find(Auth::user()->id)->jadwal;

    foreach ($userJadwal as $jadwal) {
      if($jadwal->sesi->sesi->id == $sesiID) {
        return false;
      }
    }
    return true;
  }

  public function store(Request $request) {
    $jadwal_data = $request->except("_token");

    DB::beginTransaction();

    try{
      $jadwal_data['created_by'] = Auth::user()->id;
      $jadwal_data['user_id'] = Auth::user()->id;

      Jadwal::create($jadwal_data);

      DB::commit();

      alert()->success('Data berhasil di tambahkan', 'Tambah Data Berhasil!');
      return redirect()->route('jadwal.index');
    }catch(\Exception $e){
        DB::rollback();

        throw $e;
    }
  }

  public function update(Request $request) {
    $jadwal_data = $request->except("_token");
    $jadwal = Jadwal::find($request['id']);

    DB::beginTransaction();

    try{
      $jadwal_data['updated_by'] = Auth::User()->id;
      $jadwal->update($jadwal_data);

      DB::commit();

      alert()->success('Data berhasil di ubah', 'Ubah Data Berhasil!');
      return redirect()->route('jadwal.index');
    }catch(\Exception $e){
        DB::rollback();
        throw $e;
    }
  }

  public function destroy($id) {
    DB::beginTransaction();

    try{
      $jadwal = Jadwal::find($id);
      $jadwal_data['deleted_at'] = Carbon::now();
      $jadwal_data['deleted_by'] = Auth::User()->id;
      $jadwal->update($jadwal_data);

      DB::commit();

      alert()->success('Data berhasil di hapus', 'Hapus Data Berhasil!');
      return redirect()->route('jadwal.index');
    }catch(\Exception $e){
        DB::rollback();
        throw $e;
    }
  }
}
