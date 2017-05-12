<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Prodi;
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
      $fakultas = Fakultas::all();
      return view('admin.prodi.create', compact('fakultas'));
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
        return redirect()->route('Prodi.index');
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
         return redirect()->route('Prodi.index');
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
            return redirect()->route('Prodi.index');
    }
}
