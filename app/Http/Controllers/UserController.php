<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Pegawai;
use Carbon\Carbon;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
          $users = User::all();
          return view('user-index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_data = $request->except('_token');
        User::create($user_data);
        return redirect()->route('User.index');
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
    public function update(Request $request, $id)
    {
        $user_data = $request->except('_token');
        if($request->hasFile('FOTO')) {
            $request->file('FOTO')->move('FOTO', $request->file('FOTO')->getClientOriginalName());
            $user_data['FOTO'] = $request->file('FOTO')->getClientOriginalName();
            DB::table('user')
            ->where('id',$user_data['id'])
            ->update(['fullname' => $user_data['fullname'],'npm' => $user_data['npm'],'email' => $user_data['email'],'password' => $user_data['password'],'image' => $user_data['image'],'prodi_id' => $user_data['prodi_id'],'fakultas_id' => $user_data['fakultas_id'],'updated_by' => Auth::User()->id;]);
         return redirect()->route('pegawai.index');
        }
        else {
       DB::table('user')
            ->where('id',$user_data['id'])
            ->update(['fullname' => $user_data['fullname'],'npm' => $user_data['npm'],'email' => $user_data['email'],'password' => $user_data['password'],'prodi_id' => $user_data['prodi_id'],'fakultas_id' => $user_data['fakultas_id'],'updated_by' => Auth::User()->id;]);
        }
         return redirect()->route('User.index');

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
        $user = User::where('id','=',$id)->first();
       
        DB::table('pegawai')
            ->where('ID',$id)
            ->update(['deleted_at' => $deleted_at,'deleted_by'=>$deleted_by]);
          return redirect()->route('User.index');
    }
}
