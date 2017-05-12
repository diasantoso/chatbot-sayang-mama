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
}
