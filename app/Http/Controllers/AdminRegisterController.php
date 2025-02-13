<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminRegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|string|max:20',
            'study' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->gender = $request->gender;
        $admin->study = $request->study;
        $admin->save();

        return redirect()->route('admin.login')->with('success', 'Admin registered successfully.');
    }
}
