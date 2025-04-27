<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\user;

class HomeController extends Controller
{
      public function index()
      {
        // $user = Auth::guard('admin')->user();
        // echo 'welcome ' . $user->name . '<a href="'.route('admin.logout').'">Logout</a>';
        return view('admin.dashboard');
      }

      public function logout()
      {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
      }
}
