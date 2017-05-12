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
        //
          
          return view('admin.user');
    }
}
