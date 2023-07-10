<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\HakCipta;
use App\Models\Lampiran;
use App\Models\Pencipta;
use App\Models\Sertifikat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        if (Auth::guard('admin')->check()) {
            $accPusat = HakCipta::Where('status', 1)->has('sertifikat')->count();
            $accAdmin = HakCipta::Where('status', 1)->doesntHave('sertifikat')->count();
            $tolakAdmin = HakCipta::whereIn('status', [2, 4])->where('keterangan', '<>', null)->count();
            $tolakPusat = HakCipta::whereIn('status', [2, 4])->where('keterangan', null)->count();
        } else {
            $accPusat = HakCipta::Where('status', 1)->where('pemohon_id', Auth::user()->id)->has('sertifikat')->count();
            $accAdmin = HakCipta::Where('status', 1)->where('pemohon_id', Auth::user()->id)->doesntHave('sertifikat')->count();
            $tolakAdmin = HakCipta::whereIn('status', [2, 4])->where('pemohon_id', Auth::user()->id)->where('keterangan', '<>', null)->count();
            $tolakPusat = HakCipta::whereIn('status', [2, 4])->where('pemohon_id', Auth::user()->id)->where('keterangan', null)->count();
        }
        return view('home', [
            "page" => 1,
            'accPusat' => $accPusat,
            'accAdmin' => $accAdmin,
            'tolakPusat' => $tolakPusat,
            'tolakAdmin' => $tolakAdmin,
        ]);
    }
    public function hak_cipta_tolak_admin()
    {
        if (Auth::guard('admin')->check()) {
            $tolakAdmin = HakCipta::whereIn('status', [2, 4])->where('keterangan', '<>', null)->get();
        } else {
            $tolakAdmin = HakCipta::whereIn('status', [2, 4])->where('pemohon_id', Auth::user()->id)->where('keterangan', '<>', null)->get();
        }
        return view('hak_cipta_tolak_admin', [
            'page' => 1,
            'hakCipta' => $tolakAdmin,
        ]);
    }
    public function hak_cipta_tolak_pusat()
    {
        if (Auth::guard('admin')->check()) {
            $tolakPusat = HakCipta::whereIn('status', [2, 4])->where('keterangan', null)->get();
        } else {
            $tolakPusat = HakCipta::whereIn('status', [2, 4])->where('pemohon_id', Auth::user()->id)->where('keterangan', null)->get();
        }
        return view('hak_cipta_tolak_pusat', [
            'page' => 1,
            'hakCipta' => $tolakPusat,
        ]);
    }
    public function hak_cipta_terima_admin()
    {
        if (Auth::guard('admin')->check()) {
            $accAdmin = HakCipta::Where('status', 1)->doesntHave('sertifikat')->get();
        } else {
            $accAdmin = HakCipta::Where('status', 1)->where('pemohon_id', Auth::user()->id)->doesntHave('sertifikat')->get();
        }
        return view('hak_cipta_terima_admin', [
            'page' => 1,
            'hakCipta' => $accAdmin,
        ]);
    }
}
