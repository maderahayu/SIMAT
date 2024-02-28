<?php

namespace App\Http\Controllers;

use App\Models\Pemagang;
use App\Models\Supervisor;
use App\Models\kelompok;
use App\Models\User;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
// use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class SupervisorController extends Controller
{

    public function daftarAnakMagang() {
        $userId = Auth::user()->id;
        $sup = Supervisor::where('userId', '=', $userId)->value('supervisorId');
        // dd($sup);
        $anakMagang = Pemagang::where('supervisorId', '=', $sup)->get();
        // $anakMagang = Pemagang::all();
        return view('supervisor.ListAnakMagang.index', ['magang' =>$anakMagang]);
    }

    public function editAnakMagang(String $id) {
        $anakMagang = Pemagang::where('pemagangId', '=', $id)->get();
        $idKel = $anakMagang->pluck('kelompokId');
        $kelompok = Kelompok::where('kelompokId', '=', $idKel)->get();
        // $supById = Supervisor::where('supervisorId', '=' ,$idSup)->first();
        
        // $foto = $anakMagang->pluck('fotoProfil');
        // dd(storage_path('storage/public/images/'.$foto));

        $supervisor = Supervisor::all();
        $supId = $anakMagang->pluck('supervisorId');
        // dd($supervisor);
        // dd($supervisor->supervisorId);
        return view('supervisor.ListAnakMagang.edit', ['magang' =>$anakMagang, 'kelompok'=> $kelompok, 'supId'=>$supId, 'supervisor' =>$supervisor]);
    }
    
    public function updateAnakMagang(Request $request, $pemagangId) 
    {

        $pemagang = Pemagang::where('pemagangId', $pemagangId)->first();
        
        if($request->hasFile('fotoProfil')){
            if($request->hasFile('fotoProfil')){
                File::delete(public_path('/storage/images/').$pemagang->fotoProfil);
            }

            // dd($request->fotoProfil);

            $file = $request->fotoProfil;
            $path = $request->file('lampiran');
            $path ='Foto Profil'.$pemagang->namaPemangang.'_'. time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('/storage/images'), $path); 
        }
        
        $up = DB::table('tblPemagang')->where('pemagangId', $pemagang->pemagangId)->update([
            'supervisorId' => $request->supervisorId,
            'fotoProfil' => $path
        ]);

        // dd($up);

        return redirect()->route('daftarAnakMagang')->with('Data Berhasil Diperbarui');
    }

    public  function deleteAnakMagang(Request $request, $pemagangId) 
    {
        $userId = Pemagang::select('userId')->where('pemagangId', $pemagangId)->get();
        // $magang = Pemagang::select('pemagangId', '=', $pemagangId)->delete();
        User::where('id', $userId)->delete();
        Pemagang::where('pemagangId', $pemagangId)->delete();

        return redirect()->route('daftarAnakMagang')->with(['success' => 'Data Berhasil Dihapus!']);

    }

    

    public function tugas() {
        $tugas = Tugas::inRandomOrder()->first();
        $kelompok = Kelompok::where('kelompokId', '=', $tugas->kelompokId)->first();
        $supervisor = Supervisor::where('supervisorId', '=', $tugas->supervisorId)->first();

        // dd($supervisor->supervisorId);

        $tugas = Tugas::all();
        return view('supervisor.Tugas.index', ['tugas'=> $tugas]);
    }

}