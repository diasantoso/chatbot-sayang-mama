<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Prodi;
use DB;
use App\Fakultas;
use Carbon\Carbon;
class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $fakultas = Fakultas::all();
          $prodi = Prodi::all();

          return view('admin.prodi', compact('prodi','fakultas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $created_by=Auth::User()->id;
        $prodi_data = $request->except('_token');
        $prodi_data['created_by']=$created_by;
        Prodi::create($prodi_data);
        return redirect()->route('prodi.index');
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
        $prodi = Prodi::find($id);
        $semuaFakultas = Fakultas::all();

        return view('admin.editprodi', compact('prodi', 'semuaFakultas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $updated_by=Auth::User()->id;

        $prodi_data = $request->except('_token');
        DB::table('prodi')
            ->where('id',$id)
            ->update(['fakultas_id' => $prodi_data['fakultas_id'],'nama' =>$prodi_data['nama'],'updated_by' => $updated_by]);
         return redirect()->route('prodi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted_at=Carbon::now();
        $deleted_by=Auth::User()->id;

        DB::table('prodi')
            ->where('id',$id)
            ->update(['deleted_by'=>$deleted_by,'deleted_at'=>$deleted_at]);
            return redirect()->route('prodi.index');
    }

    public function terhapusRestore($id)
  {
    DB::beginTransaction();

    try{
        $prodi = Prodi::find($id);
        $prodi->deleted_at = NULL;
        $prodi->deleted_by = NULL;
        $prodi->updated_by = Auth::user()->id;
        $prodi->save();

        DB::commit();

        alert()->success('Data berhasil di kembalikan', 'Pemulihan Berhasil!');
        return redirect()->route('prodi.index');
    }catch(\Exception $e){
        DB::rollback();

        throw $e;
    }
  }
}
