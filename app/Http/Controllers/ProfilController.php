<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function profil()
    {
        return view('profile', [
            "page" => 0
        ]);
    }
    public function profil_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
        ]);
        if (Auth::guard('admin')->check()) {
            Admin::find(Auth::user()->id)->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
            ]);
            if ($request->password) {
                Admin::find(Auth::user()->id)->update([
                    'password' => Hash::make($request->password)
                ]);
            }
            if ($image = $request->file('image')) {
                $destinationPath = 'profile/';
                $profileImage = "uid-" . Auth::user()->id . "_" . date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                Admin::find(Auth::user()->id)->update([
                    'image' => $profileImage
                ]);
            }
        } else {
            User::find(Auth::user()->id)->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
            ]);
            if ($request->password) {
                User::find(Auth::user()->id)->update([
                    'password' => Hash::make($request->password)
                ]);
            }
            if ($image = $request->file('image')) {
                $destinationPath = 'profile/';
                $profileImage = "uid-" . Auth::user()->id . "_" . date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                User::find(Auth::user()->id)->update([
                    'image' => $profileImage
                ]);
            }
        }
        return redirect()->back()->with('success', 'Data berhasil diupdate!');
    }
}
