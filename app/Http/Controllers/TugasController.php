<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use App\Models\Tugas;
use App\Models\kelompok;
use App\Models\Supervisor;
use App\Models\Lampiran;
use App\Models\Logbook;
use App\Models\Pemagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class TugasController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $sup = Supervisor::where('userId', $userId)->first();
        // dd($sup->supervisorId);
        $tasks = Tugas::where('supervisorId', $sup->supervisorId)->get();
        return view('supervisor.Tugas.index', compact('tasks'));
    }

    public function create()
    {
        $supervisor = Supervisor::all();
        // $kelompok = kelompok::all();
        $user = Auth::user()->id;
        $sup = Supervisor::where('userId', $user)->first();
        $kelompok = Kelompok::where('supervisorId', $sup->supervisorId)->get();
        return view('supervisor.Tugas.create', ['kelompok'=>$kelompok, 'supervisor'=>$supervisor]);
    }

    public function store(Request $request)
    {
        // dd($request);

        $data = $request->validate([
            'judul' => 'required|',
            'deskripsi' => 'required',
            'tglMulai' => 'required|date',
            'tglSelesai' => 'required|date|after_or_equal:tglMulai'
        ]);

        $supervisor = Supervisor::where('supervisorId', $request->supervisorId)->first();

        
        $kelompok = Kelompok::where('namaKelompok', $request->kelompokId)->first();
        $kelId = Kelompok::where('namaKelompok', '=', $request->kelompokId)->value('kelompokId');
        $nama = Auth::user()->nama;


        // dd($request->lampiran, $fileName);
        // If the intern group doesn't exist, create a new one
        if (!$kelompok) {
            $kelMagang = kelompok::create([
                'namaKelompok' => $request->kelompokId,
                'supervisorId' => $supervisor->supervisorId,
            ]);
            $kel = $kelMagang->kelompokid;
            // dd($kel->kelompokId);
        }else{
            $kel = $kelId;
        }
        // dd($kel);

        // dd($request->all());
        $tugas = Tugas::create([
            'kelompokId' => $kel,
            'supervisorId' => $request->supervisorId,
            'judul' => $request->judul,
            'deskripsi' =>$request->deskripsi,
            'tglMulai' =>$request->tglMulai,
            'tglSelesai' =>$request->tglSelesai,
            'status' => 'Baru',
        ]);

         // dd($request->file('lampiran'));
         if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $fileName ='Tugas_'.'Supervisor '. $nama.'_'. time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('/storage/file'), $fileName);  
            
            Lampiran::create([
                'tugasId' =>$tugas->tugasId,
                'userId'=> $supervisor->userId,
                'namaFile' =>$fileName
            ]);
        }else{
            return redirect()->route('task.create')->with('error', 'Please upload a file.');
        }

        // dd(public_path('/storage/file'), $fileName);

        return redirect()->route('task.index')->with('success', 'Tugas berhasil dibuat.');
    }

    public function show(Tugas $tugas)
    {
        return view('tugas.show', compact('tugas'));
    }

    public function edit($id)
    {   
        
        $tugas = Tugas::where('tugasId', $id)->get();
        $user = Auth::user()->id;
        $sup = Supervisor::where('userId', $user)->first();
        $kelompok = Kelompok::where('supervisorId', $sup->supervisorId)->get();
        // $kelompok = Kelompok::all();
        $supervisor = Supervisor::all();
        $lampiran = Lampiran::where('tugasId', $id)->orderBy('lampiranId','desc')->limit(5)->get();
        // dd($lampiran);

        return view('supervisor.Tugas.edit', ['tugas'=>$tugas, 'kelompok'=>$kelompok, 'supervisor'=>$supervisor, 'lampiran'=>$lampiran]);
    }

    public function update(Request $request, $tugasId)
    {
        // dd($request->lampiran);
        $tugas = Tugas::where('tugasId', $tugasId)->first();
        // dd(public_path('/storage/file/') .$tugas->lampiran);
        // dd($tugas->lampiran);
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tglMulai' => 'required|date',
            'tglSelesai' => 'required|date|after_or_equal:tglMulai',
            'supervisorId' => 'required',
            'kelompokId' => 'required',
        ]);

        $user = Auth::user();
               
        $tugas = DB::table('tblTugas')->where('tugasId', $tugas->tugasId)->first();

        DB::table('tblTugas')->where('tugasId', $tugas->tugasId)->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tglMulai' => $request->tglMulai,
            'tglSelesai' => $request->tglSelesai,
            'kelompokId' => $request->input('kelompokId'),
            'supervisorId' => $request->input('supervisorId')
        ]);

        if($request->hasFile('lampiran')){
            $file = $request->file('lampiran');
            $fileName ='Tugas_'.'Supervisor '. $user->nama.'_'. time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('/storage/file'), $fileName);    

            Lampiran::create([
                'tugasId'=> $tugas->tugasId,
                'userId' => $user->id,
                'namaFile' => $fileName
            ]);
        }
        
        return redirect()->route('task.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy( $tugasId)
    {
        Tugas::where('tugasId', $tugasId)->delete();
        return redirect()->route('task.index')->with('success', 'Tugas berhasil dihapus.');
    }

    public function indexTugasMagang() {
        $userId = Auth::user()->id;
        $mg = Pemagang::where('userId', $userId)->first();
        $kel = kelompok::where('kelompokId', $mg->kelompokId)->first();
        $tasks = Tugas::where('kelompokId', $mg->kelompokId)->get();
        // dd($tasks);
        return view('magang.tugas.index', compact('tasks','kel'));
    }

    public function showTugasMagang(Request $request, $id) {
        $userId = Auth::user()->id;
        $mg = Pemagang::where('userId', $userId)->first();
        $kel = kelompok::where('kelompokId', $mg->kelompokId)->first();
        $tg = Tugas::where('tugasId', $id)->first();
        $evaluasi = Evaluasi::where('tugasId', $id)->get();
        $supervisor = Supervisor::where('supervisorId', $tg->supervisorId)->first();
        $logbook = Logbook::where('tugasId', $id)->get();

        return view('magang.tugas.show', compact('tg','kel', 'supervisor', 'evaluasi','logbook'));
    }
}
