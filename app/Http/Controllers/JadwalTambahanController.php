<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Carbon\Carbon;

use App\User;
use App\Prodi;
use App\Fakultas;
use App\Jadwal_Tambahan;
use App\Makul;
use App\Sesi;

class JadwalTambahanController extends Controller
{
  public function index() {
    $userId = Auth::user()->id;
    $user = User::find($userId);

    $semuaJadwalTambahan = $user->jadwalTambahan;
    $semuaMakul=Makul::all();

    return view("admin.kuis", compact('semuaJadwalTambahan','semuaMakul'));
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
    $jadwalTambahan_data = $request->except("_token");

    $this->validate($request, [
        'nama' => 'required',
        'makul_id' => 'required',
        'keyword' => 'required',
        'type' => 'required',
    ]);

    DB::beginTransaction();

    try{
      $jadwalTambahan_data['created_by'] = Auth::user()->id;
      $jadwalTambahan_data['user_id'] =  Auth::user()->id;

      Jadwal_Tambahan::create($jadwalTambahan_data);

      DB::commit();

      alert()->success('Data berhasil di tambahkan', 'Tambah Data Berhasil!');
      return redirect()->route('jadwalTambahan.index');
    }catch(\Exception $e){
        DB::rollback();
        throw $e;
    }
  }

  public function update(Request $request, $id) {
    $jadwalTambahan_data = $request->except("_token");

    $this->validate($request, [
        'nama' => 'required',
        'makul_id' => 'required',
        'keyword' => 'required',
        'type' => 'required',
    ]);

    $jadwalTambahan = Jadwal_Tambahan::find($id);

    DB::beginTransaction();

    try{
      $jadwal_data['updated_by'] = Auth::User()->id;
      $jadwal->update($jadwalTambahan_data);

      DB::commit();

      alert()->success('Data berhasil di ubah', 'Ubah Data Berhasil!');
      return redirect()->route('jadwalTambahan.index');
    }catch(\Exception $e){
        DB::rollback();
        throw $e;
    }
  }

  public function destroy($id) {
    DB::beginTransaction();

    try{
      $jadwalTambahan = Jadwal_Tambahan::find($id);
      $jadwalTambahan_data['deleted_at'] = Carbon::now();
      $jadwalTambahan_data['deleted_by'] = Auth::User()->id;
      $jadwalTambahan->update($jadwalTambahan_data);

      DB::commit();

      alert()->success('Data berhasil di hapus', 'Hapus Data Berhasil!');
      return redirect()->route('jadwalTambahan.index');
    }catch(\Exception $e){
        DB::rollback();
        throw $e;
    }
  }
}
