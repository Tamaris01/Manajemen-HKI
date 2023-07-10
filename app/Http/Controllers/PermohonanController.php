<?php

namespace App\Http\Controllers;

use App\Models\HakCipta;
use App\Models\Lampiran;
use App\Models\Pencipta;
use App\Models\Sertifikat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermohonanController extends Controller
{
    public function permohonan()
    {
        if (Auth::guard('admin')->check()) {
            $hakCipta = HakCipta::whereIn('status', [0, 3])->get();
        } else {
            $hakCipta = HakCipta::where('pemohon_id', Auth::user()->id)->get();
        }
        return view('permohonan', [
            "hakCipta" => $hakCipta,
            "page" => 2
        ]);
    }

    public function permohonan_form(Request $request)
    {
        $p = 1;
        $uid = Auth::user()->id;

        if (Auth::guard('admin')->check()) {
            $cek1 = HakCipta::where('status', -1)->where('admin_id', $uid)->first();
            $cek2 = NULL;

            if ($cek1) {
                $p = 2;
                $cek2 = Pencipta::where('hak_cipta_id', $cek1->id)->first();

                if ($cek2) {
                    $p = 3;
                }
            }
        } else {
            $cek1 = HakCipta::where('status', -1)->where('pemohon_id', $uid)->first();
            $cek2 = NULL;

            if ($cek1) {
                $p = 2;
                $cek2 = Pencipta::where('hak_cipta_id', $cek1->id)->first();

                if ($cek2) {
                    $p = 3;
                }
            }
        }

        if ($request->p) {
            $p = $request->p;
        }

        $inputId = $request->input('id');

        return view('permohonan-form', [
            "page" => 3,
            "p" => $p,
            "pemohon" => User::get(),
            "hak_cipta_id" => $cek1->id ?? NULL,
            "draft" => $cek1 ?? NULL,
            "draft2" => $cek2 ? Pencipta::where('hak_cipta_id', $cek1->id)->get() : NULL
        ])->with('id', $inputId);
    }

    public function permohonan_add(Request $request)
    {
        $p = $request->p;
        $uid = Auth::user()->id;

        if ($p == 1) {
            $request->validate([
                'jenis_ciptaan' => 'required',
                'sub_jenis_ciptaan' => 'required',
                'judul' => 'required',
                'uraian_singkat' => 'required|string|max:100',
                'tanggal_pertama' => 'required|date',
                'kota_pertama' => 'required',
            ]);

            $input = $request->all();
            $input['pemohon_id'] = $uid;

            if (!$request->id) {
                $hakCiptaCount = HakCipta::count();
                $newNPMNumber = $hakCiptaCount + 1;
                $newNomerPermohonan = 'NPM-' . str_pad($newNPMNumber, 3, '0', STR_PAD_LEFT);
                $input['id'] = $newNomerPermohonan;
            }

            $input['status'] = -1;

            if (Auth::guard('admin')->check()) {
                $input['admin_id'] = Auth::user()->id;
                $input['pemohon_id'] = $request->pemohon_id;
            }

            $id = HakCipta::updateOrCreate(['id' => $request->id ?? $input['id']], $input);

            return redirect()->route('permohonan-form')->with('success', 'Draft!');
        } else if ($p == 2) {
            Pencipta::where("hak_cipta_id", $request->hak_cipta_id)->delete();

            $request->validate([
                'nama.*' => 'required',
                'alamat.*' => 'required',
                'kode_pos.*' => 'required',
                'provinsi.*' => 'required',
                'kota.*' => 'required',
                'email.*' => 'required|email',
            ]);

            $dataPencipta = [];
            if ($request->nama) {
                foreach ($request->nama as $key => $value) {
                    $dataPencipta[] = [
                        "hak_cipta_id" => $request->hak_cipta_id,
                        "nama" => $request->nama[$key],
                        "alamat" => $request->alamat[$key],
                        "kode_pos" => $request->kode_pos[$key],
                        "provinsi" => $request->provinsi[$key],
                        "kota" => $request->kota[$key],
                        "email" => $request->email[$key],
                    ];
                }
                Pencipta::insert($dataPencipta);
            }

            return redirect()->route('permohonan-form')->with('success', 'Draft!');
        } else if ($p == 3) {

            $request->validate([
                'contoh_ciptaan_link' => 'required',
                'ktp' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
                'contoh_ciptaan_file' => 'required|max:2048',
                'contoh_ciptaan_file.*' => 'file',
                'surat_pernyataan' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
                'bukti_pengalihan' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            ]);

            $input = $request->all();

            if ($image = $request->file('ktp')) {
                $destinationPath = 'lampiran/';
                $profileImage = "ktp_uid-" . $uid . "_" . date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input['ktp'] = $profileImage;
            }

            if ($image = $request->file('contoh_ciptaan_file')) {
                $destinationPath = 'lampiran/';
                $profileImage = "contoh_ciptaan_file_uid-" . $uid . "_" . date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input['contohciptaan_file'] = $profileImage;
            }

            if ($image = $request->file('surat_pernyataan')) {
                $destinationPath = 'lampiran/';
                $profileImage = "surat_pernyataan_uid-" . $uid . "_" . date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input['surat_pernyataan'] = $profileImage;
            }

            if ($image = $request->file('bukti_pengalihan')) {
                $destinationPath = 'lampiran/';
                $profileImage = "bukti_pengalihan_uid-" . $uid . "_" . date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input['bukti_pengalihan'] = $profileImage;
            }

            $s = 0;
            if (Auth::guard('admin')->check()) {
                $s = 1;
            }

            HakCipta::where('id', $request->hak_cipta_id)->update([
                'status' => $s
            ]);

            Lampiran::create($input);

            if (Auth::guard('admin')->check()) {
                return redirect()->route('hakcipta')->with('success', 'Data berhasil ditambah!');
            } else {
                return redirect()->route('permohonan')->with('success', 'Data berhasil ditambah!');
            }
        }
    }

    public function permohonan_terima($id, Request $request)
    {
        if ($request->link_sertifikat) {
            if ($image = $request->file('link_sertifikat')) {
                $destinationPath = 'sertifikat/';
                $sertifImage = "Sertifikat_hid-" . $id . "_" . date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $sertifImage);
                Sertifikat::create([
                    'hak_cipta_id' => $id,
                    'link_sertifikat' => $sertifImage,
                ]);
            }
        }

        HakCipta::where('id', $id)->update([
            "status" => 1,
            "admin_id" => Auth::user()->id
        ]);

        return redirect()->back()->with('success', 'Data berhasil diterima!');
    }

    public function permohonan_tolak($id, Request $request)
    {
        $cek =  HakCipta::where('id', $id)->first();
        $s = 2;

        if ($cek->status == 3) {
            $s = 4;
        }

        HakCipta::where('id', $id)->update([
            "status" => $s,
            "admin_id" => Auth::user()->id,
        ]);

        if ($request->keterangan) {
            HakCipta::where('id', $id)->update([
                "keterangan" => $request->keterangan
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil ditolak!');
    }

    public function permohonan_hapus($id)
    {
        HakCipta::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
