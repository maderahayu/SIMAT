<?php

namespace App\Http\Controllers;

use App\Models\Supervisor;
use Illuminate\Http\Request;
use App\models\kelompok;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class KelompokController extends Controller
{
    public function index() {
        $user = Auth::user()->id;
        $sup = Supervisor::where('userId', $user)->first();
        $kelompok = Kelompok::where('supervisorId', $sup->supervisorId)->get();
        // dd($sup->supervisorId);
        // dd($kelompok);
        return view('supervisor.Kelompok.index', compact('kelompok'));
    }

    public function createKelompok() {
        $supervisor = Supervisor::all();
        return view('supervisor.Kelompok.create', compact('supervisor'));
    }

    public function storeKelompok(Request $request) {
        // dd($request);
        Kelompok::create([
            'namaKelompok' => $request->namaKelompok,
            'supervisorId' => $request->supervisor
        ]);

        return redirect()->route('kelompok.index')->with(['success' => 'Kelompok Berhasil ditambahkan!']);
    }

    public function editKelompok(Request $request, $id) {
        $kelompok = Kelompok::where('kelompokId', $id)->get();
        $supervisor = Supervisor::all();
        return view('supervisor.Kelompok.edit', compact('kelompok', 'supervisor'));
    }

    public function updateKelompok(Request $request, $id) {
        // dd($request);

        $up = DB::table('tblKelompok')->where('kelompokId', $id)->update([
            'namaKelompok' => $request->namaKelompok,
            'supervisorId' => $request->supervisorId
        ]);

        return redirect()->route('kelompok.index')->with(['success' => 'Kelompok Berhasil diperbarui!']);
    }

    public function deleteKelompok($id) {
        $deleted = DB::table('tblKelompok')->where('kelompokId', '=', $id)->delete();

        return redirect()->route('kelompok.index')->with(['success' => 'Kelompok Berhasil dihapus!']);
    }
}
