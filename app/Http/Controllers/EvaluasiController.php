<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluasi;
use App\Models\kelompok;
use App\Models\Supervisor;
use App\Models\Tugas;
use App\Models\Lampiran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class EvaluasiController extends Controller
{
    public function index() {
        $userId = Auth::user()->id;
        $sup = Supervisor::where('userId', $userId)->first();
        // dd($sup->supervisorId);
        $evaluasi = Evaluasi::where('supervisorId', $sup->supervisorId)->with('task')->get();
        return view('supervisor.evaluasi.index', ['evaluasi'=>$evaluasi]);
    }

    public function createEvaluasi() {
        $tugas = Tugas::where('status', '!=', 'Selesai')->get();
        // dd($tugas->judul);
        $supervisor = Supervisor::all();
        $kelompok = kelompok::all();
        return view('supervisor.evaluasi.create', ['kelompok'=>$kelompok, 'supervisor'=>$supervisor, 'tugas'=>$tugas]);
    }

    public function storeEvaluasi(Request $request) 
    {
        $data = $request->validate([
            'task_id' => 'required',
            'kelompok' => 'required',
            'penilaian' => 'required',
            'Komentar' =>  'required',
            'tglEvaluasi' =>'required|date'
        ]);
        
        // dd($data);
        // dd($request->hasFile('lampiran'));
        $user = Auth::user();
        $kel = Kelompok::where('namaKelompok', '=', $request->kelompok)->first();
        $sup = Supervisor::where('userId', '=', $user->id)->first();

       $a = [
        'tugasId' => $request->task_id,
            'kelompokId' =>$kel->kelompokId,
            'supervisorId' => $sup->supervisorId,
            'penilaian' => $request->penilaian,
            'komentar' => $request->Komentar,
            'tglEvaluasi' => $request->tglEvaluasi,
            'lampiran' => $request->lampiran
       ];

    //    dd($a);

        $evaluasi  = Evaluasi::create([
            'tugasId' => $request->task_id,
            'kelompokId' =>$kel->kelompokId,
            'supervisorId' => $sup->supervisorId,
            'penilaian' => $request->penilaian,
            'komentar' => $request->Komentar,
            'tglEvaluasi' => $request->tglEvaluasi
        ]);

        $tgs = DB::table('tblTugas')->where('tugasId', $request->task_id)->update([
            'status' => $request->status
        ]);
        
        if($request->hasFile('lampiran')){
            $file = $request->file('lampiran');
            $fileName ='Evaluasi_'.'Supervisor_'. $user->nama.'_'. time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('/storage/file'), $fileName);    

            Lampiran::create([
                'tugasId'=> $request->task_id,
                'userId' => $user->id,
                'namaFile' => $fileName
            ]);
        }
        
        return redirect()->route('evaluasi.index')->with(['success' => 'Evaluasi Berhasil ditambahkan!']);

    }

    public function getStatus($taskId)
    {
        $task = Tugas::where('tugasId','=',$taskId)->first();
        if (!$task) {
            return response()->json(['error' => 'Task not found.'], 404);
        }

        return response()->json(['status' => $task->status], 200);
    }

    public function show($kelompokId)
    {
        $internGroup = Kelompok::where('kelompokId','=',$kelompokId)->first();
        // dd($internGroup->namaKelompok);
        if (!$internGroup) {
            return response()->json(['error' => 'Intern Group not found.'], 404);
        }

        return response()->json(['groupName' => $internGroup->namaKelompok]);
    }

    public function editEvaluasi($id) {
        $evaluasi = Evaluasi::where('evaluasiId', $id)->with('task')->get();
        $kel = $evaluasi->pluck('kelompokId');
        $tugasId = $evaluasi->pluck('tugasId');
        $kelompok = kelompok::where('kelompokId', '=', $kel)->get();
        $lampiran = Lampiran::where('tugasId', $tugasId)->orderBy('lampiranId','desc')->limit(3)->get();

        // dd($lampiran);
        return view('supervisor.evaluasi.edit', compact('evaluasi','kelompok','lampiran'));
    }

    public function updateEvaluasi(Request $request, $id) {
        // dd($request);
        // $data = $request->validate([
        //     // 'task_id' => 'required',
        //     'kelompok' => 'required',
        //     'penilaian' => 'required',
        //     'Komentar' =>  'required',
        //     'tglEvaluasi' =>'required|date',
        //     'lampiran' => 'nullable'
        // ]);

        // dd($request->judul);

        $tugas = Tugas::where('judul', $request->judul)->first();
        DB::table('tblTugas')->where('tugasId', $tugas->tugasId)->update([
            'status' => $request->status
        ]);
        DB::table('tblEvaluasi')->where('evaluasiId', $id)->update([
            'penilaian' => $request->penilaian,
            'komentar' => $request->komentar,
            'tglEvaluasi' => $request->tglEvaluasi
        ]);

        $user = Auth::user();
        if($request->hasFile('lampiran')){
            $file = $request->file('lampiran');
            $fileName ='Evaluasi_'.'Supervisor_'. $user->nama.'_'. time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('/storage/file'), $fileName);    

            Lampiran::create([
                'tugasId'=> $tugas->tugasId,
                'userId' => $user->id,
                'namaFile' => $fileName
            ]);
        }

        // dd($tugas);

        return redirect()->route('evaluasi.index')->with(['success' => 'Evaluasi Berhasil diperbarui!']);
    }

    public function deleteEvaluasi($id) {
        $evaluasi = Evaluasi::findOrFail($id);
        // dd($evaluasi->tugasId);
        // $tugas = Tugas::where('judul', $request->judul)->first();

        // Retrieve the associated files based on task_id and filename condition
        $files = Lampiran::where('tugasId', $evaluasi->tugasId)
                     ->where('namaFile', 'LIKE', 'evaluasi%')
                     ->get();

        // Delete the files from the server and remove their records from the database
        foreach ($files as $file) {
            $filePath = public_path(public_path('/storage/file/'), $file->file_path);

            // Check if the file exists on the server before attempting to delete it
            if (file_exists($filePath)) {
                // Delete the file from the server
                unlink($filePath);
            }

            // Delete the file record from the database
            $file->delete();
        }

        // Finally, delete the evaluation
        $evaluasi->delete();
        return redirect()->route('evaluasi.index')->with(['success' => 'Evaluasi Berhasil dihapus!']);

    }

   
}
