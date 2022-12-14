<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            if (auth()->guard('admin')->attempt([
                'email' => $request->email,
                'password' => $request->password,
                'status' => 1
            ])) {
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->with(['error_msg' => 'Invalid Creds']);
            }
        }
        return view('admin.login');
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect('admin/login');
    }
}
