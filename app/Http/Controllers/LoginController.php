<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function getLogin()
    {
      return view('admin.login');
    }
  
    public function postLogin(Request $request)
    {
  
        
  
        // Attempt to log the user in
        // Passwordnya pake bcrypt
      if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
          // if successful, then redirect to their intended location
        return redirect()->intended('dashboard');
      } elseif (Auth::guard('mahasiswa')->attempt(['username' => $request->username, 'password' => $request->password])) {
        // if successful, then redirect to their intended location
      return redirect()->intended('mahasiswa_pengaduan');
    } else {
        return redirect('/login')->with('message','username atau password salah');
      }
  
    }
  
    public function logout()
    {
      if (Auth::guard('admin')->check()) {
        Auth::guard('admin')->logout();
      } 
  
      return redirect('/login');
  
    }

    public function logoutmahasiswa()
    {
      if (Auth::guard('mahasiswa')->check()) {
        Auth::guard('mahasiswa')->logout();
      } 
  
      return redirect('/loginmahasiswa');
  
    }
}
