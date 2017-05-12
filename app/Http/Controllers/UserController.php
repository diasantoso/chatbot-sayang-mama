<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Prodi;
use App\Fakultas;
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
          $prodi = Prodi::all();
          $fakultas = Fakultas::all();
          return view('user-index', compact('users','fakultas','prodi'));
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
        $user_data['role']='Mahasiswa';
        $user_data = $request->except('_token');
        User::create($user_data);
        return redirect()->route('User.index');
    }
    public function storeadmin(Request $request)
    {
        $user_data['role']='Administrator';
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

    
        $updated_by=Auth::User()->id;

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
            ->update(['fullname' => $user_data['fullname'],'npm' => $user_data['npm'],'email' => $user_data['email'],'password' => $user_data['password'],'prodi_id' => $user_data['prodi_id'],'fakultas_id' => $user_data['fakultas_id'],'updated_by' => $updated_by]);
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
       
        DB::table('user')
            ->where('id',$id)
            ->update(['deleted_by'=>$deleted_by,'deleted_at'=>$deleted_at]);
            return redirect()->route('User.index');
    }

    public function doLogin(Request $request)
    {


        $userdata = $request;
        $email=$userdata->email;
        $password=$userdata->password;
        // attempt to do the login
           if (Auth::attempt(['email' => $email, 'password' => $password],true))
            {
                
                
            } 
            else {        

               

            }


    }

    public function doLogout()
    {
      Auth::logout();
      return redirect('/');
    }

}
