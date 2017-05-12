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


         $email = DB::table('users')
                ->where('email',$request['email'])
                ->count();

        if($email!=0)
        {
               alert()->error('Register Gagal', 'Email telah digunakan');
               return redirect('login.index');

        }
        else{
        $user_data = $request->except('_token');
        if($request->hasFile('image')) {
            $request->file('image')->move('uploads/ProfilePicture/', $request->file('image')->getClientOriginalName());
            $user_data['image'] = $request->file('image')->getClientOriginalName();
        }
            $user_data['password'] = bcrypt($user_data['password']);
            $user_data['role']='Mahasiswa';
            $user_data['registerdate']=Carbon::now();
            User::create($user_data);
            if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']],true))
            {
                if(Auth::User()->role=='Administrator')
                {
                     return redirect('admindashboard');
                }
                else
                {
                    return redirect('jadwal-index');
                }
               
                   
           
            }
            else {

               echo "fail";

            }
        }
    }
    public function storeadmin(Request $request)
    {

        $user_data = $request->except('_token');
        if($request->hasFile('image')) {
            $request->file('image')->move('uploads/ProfilePicture/', $request->file('image')->getClientOriginalName());
             $user_data['image'] = $request->file('image')->getClientOriginalName();
             echo "ada gambar";
        }


             $user_data['role']='Administrator';
            $user_data['registerdate']=Carbon::now();
            $user_data['password'] = bcrypt($user_data['password']);
             User::create($user_data);
            if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']],true))
            {
                if(Auth::User()->role=='Administrator')
                {
                     return redirect('admindashboard');
                }
                else
                {
                    return redirect('jadwal-index');
                }
               
                   
           
            }
            else {

               echo "fail";

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


        $updated_by=Auth::User()->id;

        $user_data = $request->except('_token');
        if($request->hasFile('image')) {
            $request->file('image')->move('uploads/ProfilePicture', "coba.jpg");
            $user_data['image'] = $request->file('image')->getClientOriginalName();
            DB::table('users')
            ->where('id',$user_data['id'])
            ->update(['fullname' => $user_data['fullname'],'npm' => $user_data['npm'],'email' => $user_data['email'],'image' => $user_data['image'],'prodi_id' => $user_data['prodi_id'],'fakultas_id' => $user_data['fakultas_id'],'updated_by' => Auth::User()->id]);
          return redirect()->route('user.index');
        }
        else {
       DB::table('users')
            ->where('id',$user_data['id'])
            ->update(['fullname' => $user_data['fullname'],'npm' => $user_data['npm'],'email' => $user_data['email'],'prodi_id' => $user_data['prodi_id'],'fakultas_id' => $user_data['fakultas_id'],'updated_by' => $updated_by]);
        }
         return redirect()->route('user.index');

    }
    public function updateadmin(Request $request)
    {


        $updated_by=Auth::User()->id;

        $user_data = $request->except('_token');
        if($request->hasFile('image')) {
            $request->file('image')->move('uploads/ProfilePicture', $request->file('image')->getClientOriginalName());
            $user_data['image'] = $request->file('image')->getClientOriginalName();
            DB::table('users')
            ->where('id',$user_data['id'])
            ->update(['fullname' => $user_data['fullname'],'npm' => $user_data['npm'],'email' => $user_data['email'],'image' => $user_data['image'],'updated_by' => Auth::User()->id]);
           return redirect()->route('user.index');
        }
        else {
       DB::table('users')
            ->where('id',$user_data['id'])
            ->update(['fullname' => $user_data['fullname'],'npm' => $user_data['npm'],'email' => $user_data['email'],'updated_by' => $updated_by]);
        }
         return redirect()->route('user.index');

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
            return redirect()->route('user.index');
    }

    public function aktifkan($id)
    {


        DB::table('users')
            ->where('id',$id)
            ->update(['deleted_by'=>NULL,'deleted_at'=>NULL]);
            return redirect()->route('user.index');
    }



}
