<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Prodi;
use App\Fakultas;
use App\Sesi;
use App\Makul;
use DB;
class LoginController extends Controller
{
     public function index()
    {
    	  $semuaProdi = Prodi::all();
        $semuaFakultas = Fakultas::all();
        return view('loginregister.login', compact('users','semuaFakultas','semuaProdi'));
    }
     public function register()
    {
        $semuaProdi = Prodi::all();
        $semuaFakultas = Fakultas::all();
        return view('loginregister.register', compact('users','semuaFakultas','semuaProdi'));
    }
     public function admindashboard()
    {
    	  $totalUser = User::all()->where('deleted_at','=' ,NULL)->count();
    	  $totalProdi = Prodi::all()->where('deleted_at','=' ,NULL)->count();
        $totalFakultas = Fakultas::all()->where('deleted_at','=' ,NULL)->count();
        $totalSesi = Sesi::All()->where('deleted_at','=' ,NULL)->count();
        $totalMakul = Makul::All()->where('deleted_at','=' ,NULL)->count();
        return view('admin.dashboard', compact('totalUser','totalFakultas','totalProdi','totalSesi','totalMakul'));
    }

    public function doLogin(Request $request)
    {


        $userdata = $request;
        $email=$userdata->email;
        $password=$userdata->password;
        // attempt to do the login
           if (Auth::attempt(['email' => $email, 'password' => $password],true))
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


               alert()->error('Login Gagal', 'username atau password salah');
               return redirect('login.index');

            }


    }

    public function doLogout()
    {
      Auth::logout();
      return redirect('/');
    }
}
