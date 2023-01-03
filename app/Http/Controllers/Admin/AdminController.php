<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required'
            ]);

            if (auth()->guard('admin')->attempt([
                'email' => $request->email,
                'password' => $request->password,
                'status' => 1
            ])) {
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->with(['error_msg' => 'Invalid Email or password']);
            }
        }
        return view('admin.login');
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect('admin/login');
    }

    public function updatePassword(Request $request)
    {
        if($request->isMethod('post')){

            $data = $request->all();
           
            if(Hash::check($data['current_password'], auth()->guard('admin')->user()->password)){

                if($data['new_password'] == $data['confirm_password']){
                    auth()->guard('admin')->user()->update([
                        'password' => bcrypt($data['new_password'])
                    ]);
                    return redirect()->back()->with(['success' => 'Password has been updated successfully']);
                } else {
                    return redirect()->back()->with(['error' => 'New password and confirm password do not match!']);

                }
              
            } else{
                return redirect()->back()->with(['error' => 'Current password is not correct!']);
            }
        }
        $adminDetails = auth()->guard('admin')->user()->first()->toArray();
        return view('admin.settings.update_password' , compact('adminDetails'));
    }

    public function checkPassword(Request $request)
    {
      $data = $request->all();
      if(Hash::check($data['current_password'], auth()->guard('admin')->user()->password)){
        return 'true';
      }else{
        return 'false';

      }
    }
}
