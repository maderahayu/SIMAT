<?php

namespace App\Http\Controllers;

use App\Models\Lampiran;
use App\Models\Logbook;
use App\Models\Pemagang;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class LogbookController extends Controller
{
    //
    public function index() {
        $user = Auth::user();
        $mg = Pemagang::where('userId', $user->id)->first();
        $logbook = Logbook::where('pemagangId', $mg->pemagangId)->get();
        // dd($logbook);
        return view('magang.logbook.index', compact('logbook'));
    }

    public function createLogbook() {
        $user = Auth::user();
        $mg = Pemagang::where('userId', $user->id)->first();
        $tugas = Tugas::where('kelompokId', $mg->kelompokId)->get();
        return view('magang.logbook.create', compact('tugas'));
    }

    public function storeLogbook(Request $request) 
    {
        // $this->validate($request, [
        //     'tugasId' => 'required',
        //     'tglLogbook' => 'required|date|before:today',
        //     'deskripsi' => 'required',
        //     'status' => 'required',
        //     'lampiran' => 'nullable',
        // ]);
        
        $user = Auth::user();
        $mg = Pemagang::where('userId', $user->id)->first();
        $tgs = Tugas::where('judul', $request->tugasId)->first();

        // dd($tgs->tugasId);
        Logbook::create([
            'tugasId'=> $tgs->tugasId,
            'pemagangId'=> $mg->pemagangId,
            'tglLogbook'=> $request->tglLogbook,
            'deskripsi'=> $request->deskripsi,
        ]);

        DB::table('tblTugas')->where('tugasId', $tgs->tugasId)->update([
            'status' => $request->status
        ]);

        if($request->hasFile('lampiran')){
            $file = $request->file('lampiran');
            $fileName ='progres_'.'Magang_'. $user->nama.'_'. time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('/storage/file'), $fileName);    

            Lampiran::create([
                'tugasId'=> $tgs->tugasId,
                'userId' => $user->id,
                'namaFile' => $fileName
            ]);
        }
        
        // dd($request);

        return redirect()->route('logbookIndex')->with(['success' => 'Logbook Berhasil ditambahkan!']);

    }

    public function editLogbook($id) {
        $logbook = Logbook::where('logbookId', $id)->get();
        $tgId = $logbook->pluck('tugasId');
        // $tugas = Tugas::where('kelompokId', $tgId)->get();
        // dd($tugas);
        $lampiran = Lampiran::where('tugasId', $tgId)->where('namaFile', 'LIKE', 'progres%')->orderBy('lampiranId','desc')->limit(3)->get();
        return view('magang.logbook.edit', compact('logbook','lampiran'));
    }

    public function updateLogbook(Request $request, $id) {
        // dd($request);
        // $this->validate($request, [
        //     'tugasId' => 'required',
        //     'tglLogbook' => 'required|date|before:today',
        //     'deskripsi' => 'required',
        //     'status' => 'required',
        //     'lampiran' => 'nullable',
        // ]);
        $user = Auth::user();


        $mg = Pemagang::where('userId', $user->id)->first();
        $tgs = Tugas::where('judul', $request->tugasId)->first();

        // dd($request->tugasId, $tgs->tugasId);

        DB::table('tblLogbook')->where('logbookId', $id)->update([
            'tglLogbook' => $request->tglLogbook,
            'deskripsi' => $request->deskripsi,
            'pemagangId' => $mg->pemagangId
        ]);

        DB::table('tblTugas')->where('tugasId', $tgs->tugasId)->update([
            'status' => $request->status
        ]);
        if($request->hasFile('lampiran')){
            $file = $request->file('lampiran');
            $fileName ='progres_'.'Magang_'. $user->nama.'_'. time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('/storage/file'), $fileName);    

            Lampiran::create([
                'tugasId'=> $tgs->tugasId,
                'userId' => $user->id,
                'namaFile' => $fileName
            ]);
        }
        return redirect()->route('logbookIndex')->with(['success' => 'Logbook Berhasil diperbarui!']);
    }
    
    public function deleteLogbook($id) {
        $logbook = Logbook::findOrFail($id);
        $logbook->delete();
        return redirect()->route('logbookIndex')->with(['success' => 'Logbook Berhasil dihapus!']);
    }

    //belum
    public function cetakPDF(Request $request) {
        $user = Auth::user();
        $mg = Pemagang::where('userId', $user->id)->first();
        $tugas = Tugas::where('kelompokId', $mg->kelompokId)->get();
        $logbook = Logbook::where('pemagangId', $mg->pemagangId)->get();


        if($request->has('download')){
            $pdf = PDF::loadView('magang.logbook.cetak',['logbook'=>$logbook]);
            return $pdf->download('pdfview.pdf');
        }
        // return view('magang.logbook.cetak', compact('logbook'));
        return redirect()->route('logbookIndex')->with(['success' => 'Logbook Berhasil dicetak!']);
    }
}
