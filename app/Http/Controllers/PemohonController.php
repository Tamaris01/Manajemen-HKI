<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class PemohonController extends Controller
{
    public function users()
    {
        return view('users', [
            "users" => User::get(),
            "page" => 5
        ]);
    }
    public function users_tambah(Request $request)
    {
        $request->validate([
            'id' => 'required|unique:pemohon',
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        User::create([
            'id' => $request->id,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }
    public function users_update(Request $request)
    {
        User::find($request->id)->update([
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
    public function users_delete($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
