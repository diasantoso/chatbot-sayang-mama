<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Prodi;
use App\Fakultas;
use Carbon\Carbon;
use DB;
use File;
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
          $prodi = Prodi::all();
          $fakultas = Fakultas::all();
          return view('admin.user', compact('users','fakultas','prodi'));
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
        if($request->hasFile('image')) {
            $request->file('image')->move('image', $request->file('image')->getClientOriginalName());   
        }
          $user_data['image'] = $request->file('FOTO')->getClientOriginalName();
            $user_data['role']='Mahasiswa';
            $user_data['registerdate']=Carbon::now();
            User::create($user_data);
            return redirect()->route('User');
    }
    public function storeadmin(Request $request)
    {
       
        $user_data = $request->except('_token');
        if($request->hasFile('image')) {
            $request->file('image')->move('image', $request->file('image')->getClientOriginalName());   
        }
          $user_data['image'] = $request->file('FOTO')->getClientOriginalName();
            $user_data['role']='Administrator';
            $user_data['registerdate']=Carbon::now();
            User::create($user_data);
            return redirect()->route('User');
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

    
        $updated_by=Auth::Users()->id;

        $user_data = $request->except('_token');
        if($request->hasFile('image')) {
            $request->file('image')->move('image', $request->file('image')->getClientOriginalName());
            $user_data['image'] = $request->file('image')->getClientOriginalName();
            DB::table('user')
            ->where('id',$user_data['id'])
            ->update(['fullname' => $user_data['fullname'],'npm' => $user_data['npm'],'email' => $user_data['email'],'password' => $user_data['password'],'image' => $user_data['image'],'prodi_id' => $user_data['prodi_id'],'fakultas_id' => $user_data['fakultas_id'],'updated_by' => Auth::User()->id]);
         return redirect()->route('User');
        }
        else {
       DB::table('users')
            ->where('id',$user_data['id'])
            ->update(['fullname' => $user_data['fullname'],'npm' => $user_data['npm'],'email' => $user_data['email'],'password' => $user_data['password'],'prodi_id' => $user_data['prodi_id'],'fakultas_id' => $user_data['fakultas_id'],'updated_by' => $updated_by]);
        }
         return redirect()->route('User');

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
       
        DB::table('users')
            ->where('id',$id)
            ->update(['deleted_by'=>$deleted_by,'deleted_at'=>$deleted_at]);
            return redirect()->route('User.index');
    }

    

}
