<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

use DB;
use File;
use Response;

use Auth;
use App\Http\Requests;
use App\Fakultas;
use App\Prodi;
use App\Users;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $semuaFakultas = Fakultas::all();
        return view('front.fakultas.index', compact('semuaFakultas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('front.fakultas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        DB::beginTransaction();

        try{
            $fakultas_data['nama'] = $input;
            $fakultas_data['created_by'] = Auth::user()->id;

            Fakultas::create($fakultas_data);

            DB::commit();

            alert()->success('Data berhasil di tambahkan', 'Tambah Data Berhasil!');
            return redirect()->route('fakultas.index');
        }catch(\Exception $e){
            DB::rollback();

            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        DB::beginTransaction();

        try{
            $fakultas_dataBaru['nama'] = $input;
            $fakultas_dataBaru['updated_by'] = Auth::user()->id;

            $fakultas = Fakultas::find($id);

            $fakultas->update($fakultas_dataBaru);

            DB::commit();

            alert()->success('Data berhasil di edit', 'Edit Berhasil!');
            return redirect()->route('fakultas.index');
        }catch(\Exception $e){
            DB::rollback();

            throw $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::beginTransaction();

        try{
            $fakultas = Fakultas::find($id);
            $fakultas->deleted_at = Carbon::now();
            $fakultas->deleted_by = Auth::user()->id;
            $fakultas->save();

            Prodi::where('fakultas_id', $id)->update(['deleted_at' => Carbon::now(), 'deleted_by' => Auth::user()->id]);

            DB::commit();

            alert()->success('Data berhasil di hapus', 'Hapus Berhasil!');
            return redirect()->route('fakultas.index');

        }catch(\Exception $e){
            DB::rollback();

            throw $e;
        }
    }

    public function terhapusRestore($id)
    {
      DB::beginTransaction();

      try{
          $fakultas = Fakultas::find($id);
          $fakultas->deleted_at = NULL;
          $fakultas->deleted_by = NULL;
          $fakultas->updated_by = Auth::user()->id;
          $fakultas->save();

          Prodi::where('fakultas_id', $id)->update(['deleted_at' => NULL, 'deleted_by' => NULL, 'updated_by' => Auth::user()->id]);

          DB::commit();

          alert()->success('Data berhasil di kembalikan', 'Pemulihan Berhasil!');
          return redirect()->route('fakultas.index');
      }catch(\Exception $e){
          DB::rollback();

          throw $e;
      }
    }

    public function terhapusDestroy($id)
    {
      DB::beginTransaction();

      try{
          $fakultas = Fakultas::find($id);
          $fakultas->delete();

          DB::commit();

          alert()->success('Data berhasil di hapus permanen', 'Hapus Permanen!');
          return redirect()->route('fakultas.index');
      }catch(\Exception $e){
          DB::rollback();

          throw $e;
      }
    }

}
