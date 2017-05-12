<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use DB;
use File;
use Response;

use Auth;
use App\Http\Requests;
use App\Makul;
use App\Users;

class MakulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $semuaMakul= Makul::all();
        return view("front.makul.index", compact("semuaMakul"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('front.makul.index');
    }


    public function checkDuplicate($nama) {
       $makulCheck = Makul::select('id')->where([
         ['nama', 'LIKE', $nama]
         ])->get()->count();

       if($sesiCheck == 0) {
         return true;
       } else {
         return false;
       }
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
        $makul_data = $request->except('_token');

        $this->validate($request, [
            'nama' => 'required',
        ]);

        if($this->checkDuplicate($makul_data['nama']) == true ) {
          $makul_data['created_by'] = Auth::user()->id;

          DB::beginTransaction();

          try{
            Sesi::create($makul_data);

            DB::commit();

            alert()->success('Data berhasil di tambahkan', 'Tambah Data Berhasil!');
            return redirect()->route('makul.index');
          }catch(\Exception $e){
              DB::rollback();

              throw $e;
          }
        } else {
          alert()->error('Maaf makul sudah ada', 'Makul Sudah Ada!');
          return redirect()->route('makul.index');
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
        $makul = Makul::find($id);
        return view('front.makul.edit', compact('makul'));
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
        $makul_data = $request->except('_token');

        $this->validate($request, [
            'nama' => 'required',
        ]);

        if($this->checkDuplicate($makul_data['nama']) == true ) {
          $makul_data['updated_by'] = Auth::user()->id;

          DB::beginTransaction();

          try{
              $makul = Sesi::find($id);
              $makul->update($makul_data);

              DB::commit();

              alert()->success('Data berhasil di edit', 'Edit Berhasil!');
              return redirect()->route('makul.index');
          }catch(\Exception $e){
              DB::rollback();

              throw $e;
          }
        } else {
          alert()->error('Maaf makul sudah ada', 'Makul Sudah Ada!');
          return redirect()->route('makul.index');
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
        $makul = Makul::find($id);

        $makul->deleted_by = Auth::user()->id;
        $makul->deleted_at = Carbon::now();

        $sesi->save();

        DB::commit();

        alert()->success('Data berhasil di hapus', 'Hapus Berhasil!');
        return redirect()->route('makul.index');
      } catch (\Exception $e) {
        DB::rollback();

        throw $e;
      }
    }

    public function terhapusRestore($id)
    {
      DB::beginTransaction();

      try{
          $makul = Makul::find($id);
          $makul->deleted_at = NULL;
          $makul->deleted_by = NULL;
          $makul->updated_by = Auth::user()->id;
          $makul->save();

          DB::commit();

          alert()->success('Data berhasil di kembalikan', 'Pemulihan Berhasil!');
          return redirect()->route('makul.index');
      }catch(\Exception $e){
          DB::rollback();

          throw $e;
      }
    }

}
