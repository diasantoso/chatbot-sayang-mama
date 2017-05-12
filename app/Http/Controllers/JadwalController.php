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

    return view("front.jadwal.index", compact(
      'semuaJadwal'
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

    $this->validate($request, [
        'nama' => 'required',
        'sesi_prodi_id' => 'required',
        'makul_id' => 'required',
        'keyword' => 'required',
        'kelas' => 'required',
        'ruangan' => 'required',
    ]);

    DB::beginTransaction();

    try{
      Jadwal::create($jadwal_data);

      DB::commit();

      alert()->success('Data berhasil di tambahkan', 'Tambah Data Berhasil!');
      return redirect()->route('jadwal.index');
    }catch(\Exception $e){
        DB::rollback();

        throw $e;
    }
  }

  public function update(Request $request, $id) {
    $jadwal_data = $request->except("_token");

    $this->validate($request, [
        'nama' => 'required',
        'sesi_prodi_id' => 'required',
        'makul_id' => 'required',
        'keyword' => 'required',
        'kelas' => 'required',
        'ruangan' => 'required',
    ]);

    $jadwal = Jadwal::find($id);

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
