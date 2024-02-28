<?php

namespace App\Http\Controllers;

use App\Models\kelompok;
use App\Models\Pemagang;
use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemagangController extends Controller
{
    //
    public function createPemagang() {
        // $kelompok= kelompok::pluck('namaKelompok');
        // $user = Auth::user()->id;
        // $sup = Supervisor::where('userId', $user)->first();
        // $kelompok = Kelompok::pluck('namaKelompok')->where('supervisorId', $sup->supervisorId)->get();
        $user = auth()->id();
        $supervisor = Supervisor::where('userId', $user)->first();
        $kelompok = Kelompok::where('supervisorId', $supervisor->supervisorId)->pluck('namaKelompok')->toArray();
        
        return view('supervisor.HakPemagang.index', compact('kelompok'));
    }

    public function createPemagangAkun(Request $request)  {
        // dd($request);
        $this->validate($request,[
            'namaPemagang'=> 'required',
            'email'=> 'required|unique:users',
            'namaUniversitas'=> 'required',
            'kelompokId'=> 'required',
            'tglMulai'=>'required|date',
            'tglSelesai'=>'required|date|after_or_equal:tglMulai',
        ]);

        $id = Auth::user()->id;
        $supervisor = Supervisor::where('userId', $id)->first();
        
        $kelompok = Kelompok::where('namaKelompok', $request->kelompokId)->first();
        $kelId = Kelompok::where('namaKelompok', '=', $request->kelompokId)->value('kelompokId');

        // dd($kelompok== null);

        // If the intern group doesn't exist, create a new one
        // dd($kelompok !=null);
        if($kelompok !=null){
            $kel = $kelId;
        }else{
            $kelMagang = kelompok::create([
                'namaKelompok' => $request->kelompokId,
                'supervisorId' => $supervisor->supervisorId,
            ]);
            $kel = $kelMagang->kelompokId;
            // dd("kelompok",$kel);
        }
        
        $users = User::create([
            'nama' => $request->namaPemagang,
            'email' => $request->email,
            'password' => bcrypt('user1212'),
            'type' => 0
        ]);
        
       

        // dd($users->id);
        // dd("kelompok",$kel);
       $magang =  Pemagang::create([
            'userId'=> $users->id,
            'kelompokId' => $kel,
            'supervisorId' => $supervisor->supervisorId,
            'namaPemagang'=> $request->namaPemagang,
            'namaUniversitas' => $request->namaUniversitas,
            'fotoProfil' => '',
            'tglMulai' => $request->tglMulai,
            'tglSelesai' => $request->tglSelesai,
            'noTelp'=> ''
        ]);

        // dd($magang);


        return redirect()->route('createPemagang')->with(['success' => 'Akun anak magang berhasil ditambahkan!']);
    }
}
