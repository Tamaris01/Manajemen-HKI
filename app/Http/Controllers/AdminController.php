<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function admin()
    {
        return view('admin', [
            "admin" => Admin::get(),
            "page" => 6
        ]);
    }
    public function admin_tambah(Request $request)
    {
        $request->validate([
            'id' => 'required|unique:pemohon',
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        Admin::create([
            'id' => $request->id,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }
    public function admin_update(Request $request)
    {
        Admin::find($request->id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ]);
        if ($request->password) {
            User::find($request->id)->update([
                'password' => Hash::make($request->password)
            ]);
        }
        return redirect()->back()->with('success', 'Data berhasil diupdate!');
    }
    public function admin_delete($id)
    {
        Admin::find($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
