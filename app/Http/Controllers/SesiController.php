<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use DB;
use File;
use Response;

use Auth;
use App\Http\Requests;
use App\Sesi;
use App\User;

class SesiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $semuaSesi = Sesi::all();
        return view("admin.sesi", compact("semuaSesi"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.sesi');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function checkDuplicate($sesi, $hari) {
        $sesiCheck = Sesi::select('id')->where([
          ['hari', 'LIKE', $hari],
          ['sesi', '=', $sesi]
          ])->get()->count();

        if($sesiCheck == 0) {
          return true;
        } else {
          return false;
        }
      }

    public function store(Request $request)
    {
        //
        $sesi_data = $request->except('_token');

        $this->validate($request, [
            'sesi' => 'required',
            'hari' => 'required',
        ]);

        if($this->checkDuplicate($sesi_data['sesi'], $sesi_data['hari']) == true ) {
          $sesi_data['created_by'] = Auth::user()->id;

          DB::beginTransaction();

          try{
            Sesi::create($sesi_data);

            DB::commit();

            alert()->success('Data berhasil di tambahkan', 'Tambah Data Berhasil!');
            return redirect()->route('sesi.index');
          }catch(\Exception $e){
              DB::rollback();

              throw $e;
          }
        } else {
          alert()->error('Maaf sesi sudah ada', 'Sesi Sudah Ada!');
          return redirect()->route('sesi.index');
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
        $sesi = Makul::find($id);
        return view('front.sesi.edit', compact('sesi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $sesi_data = $request->except('_token');

        $this->validate($request, [
            'sesi' => 'required',
            'hari' => 'required',
        ]);

        if($this->checkDuplicate($sesi_data['sesi'], $sesi_data['hari']) == true ) {
          $sesi_data['updated_by'] = Auth::user()->id;

          DB::beginTransaction();

          try{
              $sesi = Sesi::find($sesi_data['id']);
              $sesi->update($sesi_data);

              DB::commit();

              alert()->success('Data berhasil di edit', 'Edit Berhasil!');
              return redirect()->route('sesi.index');
          }catch(\Exception $e){
              DB::rollback();

              throw $e;
          }
        } else {
          alert()->error('Maaf sesi sudah ada', 'Sesi Sudah Ada!');
          return redirect()->route('sesi.index');
        }
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

      try {
        $sesi = Sesi::find($id);

        $sesi->deleted_by = Auth::user()->id;
        $sesi->deleted_at = Carbon::now();

        $sesi->save();

        DB::commit();

        alert()->success('Data berhasil di hapus', 'Hapus Berhasil!');
        return redirect()->route('sesi.index');
      } catch (\Exception $e) {
        DB::rollback();

        throw $e;
      }
    }
/*
    public function terhapusRestore($id)
    {
      DB::beginTransaction();

      try{
          $sesi = Sesi::find($id);
          $sesi->deleted_at = NULL;
          $sesi->deleted_by = NULL;
          $sesi->updated_by = Auth::user()->id;
          $sesi->save();

          DB::commit();

          alert()->success('Data berhasil di kembalikan', 'Pemulihan Berhasil!');
          return redirect()->route('sesi.index');
      }catch(\Exception $e){
          DB::rollback();

          throw $e;
      }
    }
    */

}
