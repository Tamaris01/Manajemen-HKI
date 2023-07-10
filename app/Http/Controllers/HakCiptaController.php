<?php

namespace App\Http\Controllers;


use App\Models\HakCipta;
use App\Models\Lampiran;
use App\Models\Pencipta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;





class HakCiptaController extends Controller
{
    public function exportPDF()
    {

        $accPusat = HakCipta::Where('status', 1)->has('sertifikat')->get();
        return view('print', ['data' => $accPusat]);
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
    public function hak_cipta()
    {
        if (Auth::guard('admin')->check()) {
            $hakCipta = HakCipta::where('status', 1)->whereHas('sertifikat')->get();
        } else {
            $hakCipta = HakCipta::where('status', 1)->where('pemohon_id', Auth::user()->id)->whereHas('sertifikat')->get();
        }
        return view('hak_cipta', [
            "hakCipta" => $hakCipta,
            "page" => 4
        ]);
    }
    public function hak_cipta_edit($id)
    {
        $hakCipta =  HakCipta::find($id);
        return view('hak_cipta_edit', [
            "hakCipta" => $hakCipta,
            "page" => 4
        ]);
    }
    public function hak_cipta_update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'jenis_ciptaan' => 'required',
            'sub_jenis_ciptaan' => 'required',
            'judul' => 'required',
            'uraian_singkat' => 'required',
            'tanggal_pertama' => 'required|date',
            'kota_pertama' => 'required',
            'contoh_ciptaan_link' => 'required',
            'ktp' => 'mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'contoh_ciptaan_file' => 'mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'surat_pernyataan' => 'mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'bukti_pengalihan' => 'mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        $request->validate([
            'nama.*' => 'required',
            'alamat.*' => 'required',
            'kode_pos.*' => 'required',
            'provinsi.*' => 'required',
            'kota.*' => 'required',
            'email.*' => 'required|email',
        ]);
        if (!Auth::guard('admin')->check()) {
            HakCipta::where('id', $request->id)->update([
                'keterangan' => null,
                'status' => 3
            ]);
        }
        HakCipta::where('id', $request->id)->update([
            'jenis_ciptaan' => $request->jenis_ciptaan,
            'sub_jenis_ciptaan' => $request->sub_jenis_ciptaan,
            'judul' => $request->judul,
            'uraian_singkat' => $request->uraian_singkat,
            'tanggal_pertama' => $request->tanggal_pertama,
            'kota_pertama' => $request->kota_pertama,
        ]);
        $uid = Auth::user()->id;
        $input['contoh_ciptaan_link'] = $request->contoh_ciptaan_link;
        if ($image = $request->file('ktp')) {
            $destinationPath = 'lampiran/';
            $profileImage = "ktp_uid-" . $uid . "_" . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['ktp'] = "$profileImage";
        }
        if ($image = $request->file('contoh_ciptaan_file')) {
            $destinationPath = 'lampiran/';
            $profileImage = "contoh_ciptaan_file_uid-" . $uid . "_" . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['contoh_ciptaan_file'] = "$profileImage";
        }
        if ($image = $request->file('surat_pernyataan')) {
            $destinationPath = 'lampiran/';
            $profileImage = "surat_pernyataan_uid-" . $uid . "_" . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['surat_pernyataan'] = "$profileImage";
        }
        if ($image = $request->file('bukti_pengalihan')) {
            $destinationPath = 'lampiran/';
            $profileImage = "bukti_pengalihan_uid-" . $uid . "_" . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['bukti_pengalihan'] = "$profileImage";
        }
        Lampiran::where('hak_cipta_id', $request->id)->update($input);
        $data = HakCipta::find($request->id);
        //hapus semua anak pencipta
        $data->pencipta()->delete();

        $dataPencipta = [];
        foreach ($request->nama as $key => $value) {
            $dataPencipta[] = [
                "hak_cipta_id" => $request->id,
                "nama" => $request->nama[$key],
                "alamat" => $request->alamat[$key],
                "kode_pos" => $request->kode_pos[$key],
                "provinsi" => $request->provinsi[$key],
                "kota" => $request->kota[$key],
                "email" => $request->email[$key],
            ];
        }
        Pencipta::insert($dataPencipta);
        if (Auth::guard('admin')->check()) {
            return redirect()->route('hakcipta')->with('success', 'Data berhasil diupdate!');
        } else {
            return redirect()->route('permohonan')->with('success', 'Data berhasil diupdate!');
        }
    }
    public function hak_cipta_hapus($id)
    {
        HakCipta::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
