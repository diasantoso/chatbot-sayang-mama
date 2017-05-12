<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Prodi;
use App\Fakultas;
use App\Sesi;
class LoginController extends Controller
{
     public function index()
    {
    	  $semuaProdi = Prodi::all();
        $semuaFakultas = Fakultas::all();
        return view('loginregister.login', compact('users','semuaFakultas','semuaProdi'));
    }
     public function admindashboard()
    {
    	  $totalUser = User::all()->count();
    	  $totalProdi = Prodi::all()->count();
          $totalFakultas = Fakultas::all()->count();
          $totalSesi = Sesi::all()->count();
          return view('admin.dashboard', compact('totalUser','totalFakultas','totalProdi','totalSesi'));
    }

    public function doLogin(Request $request)
    {


        $userdata = $request;
        $email=$userdata->email;
        $password=$userdata->password;
        // attempt to do the login
           if (Auth::attempt(['email' => $email, 'password' => $password],true))
            {

                return redirect('admindashboard');
            }
            else {

               echo "fail";

            }


    }

    public function doLogout()
    {
      Auth::logout();
      return redirect('/');
    }
}
