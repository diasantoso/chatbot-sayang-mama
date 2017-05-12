<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Users;
use App\Prodi;
use App\Fakultas;

class LoginController extends Controller
{
     public function index()
    {
    	  $semuaProdi = Prodi::all();
          $semuaFakultas = Fakultas::all();
          return view('loginregister.login', compact('users','semuaFakultas','semuaProdi'));
    }
    public function doLogin(Request $request)
    {


        $userdata = $request;
        $email=$userdata->email;
        $password=$userdata->password;
        // attempt to do the login
           if (Auth::attempt(['email' => $email, 'password' => $password],true))
            {
                return redirect()->route('user.index');
                
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
