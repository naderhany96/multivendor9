<?php

namespace App\Http\Controllers\Admin;

use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
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
        if ($request->isMethod('post')) {

            $data = $request->all();

            if (Hash::check($data['current_password'], auth()->guard('admin')->user()->password)) {

                if ($data['new_password'] == $data['confirm_password']) {
                    auth()->guard('admin')->user()->update([
                        'password' => bcrypt($data['new_password'])
                    ]);
                    return redirect()->back()->with(['success' => 'Password has been updated successfully']);
                } else {
                    return redirect()->back()->with(['error' => 'New password and confirm password do not match!']);
                }
            } else {
                return redirect()->back()->with(['error' => 'Current password is not correct!']);
            }
        }
        $adminDetails = auth()->guard('admin')->user()->first()->toArray();
        return view('admin.settings.update_password', compact('adminDetails'));
    }

    public function checkPassword(Request $request)
    {
        $data = $request->all();
        if (Hash::check($data['current_password'], auth()->guard('admin')->user()->password)) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function updateDetails(Request $request)
    {
        $admin =  auth()->guard('admin')->user();

        if ($request->isMethod('post')) {

            $data = $request->all();

            $request->validate([
                'name' => 'required|regex:/^[\pL\s\-]+$/u|max:20',
                'mobile' => 'required|numeric|min:14',
                'image' => 'nullable|image'
            ]);

            $admin->update($request->except('image'));

            //dealing with  image
            if ($request->hasFile('image') && $request->file('image')->isValid()) {

                if ($admin->image != 'default_user.png') {
                    File::delete(public_path() . "\admin\images\profiles\\" . $admin->image);
                }

                $img_name = rand(1, 9999) . '_' . $request->file('image')->getClientOriginalName();
                Image::make($request->file('image')->getRealPath())->save(public_path('admin\images\profiles\\' . $img_name));
                $admin->update(['image' => $img_name]);
            }

            return redirect()->back();
        }
        $adminDetails = $admin->first()->toArray();
        return view('admin.settings.update_details', compact('adminDetails'));
    }
}
