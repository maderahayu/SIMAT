<?php
 
namespace App\Http\Controllers;

use App\Models\Pemagang;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

 
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index()
    {
        $anakMagang = DB::table('tblPemagang')->get();
        return view('magang.home', ['magang' =>$anakMagang]);
    }
 
    public function supervisorHome()
    {
        return view('supervisor.home');
    }

    public function nav()  {
        $id = Auth::user()->id;
        $magang = Pemagang::pluck('fotoProfil')->where('userId', $id)->first();
        $supervisor = Supervisor::pluck('fotoProfil')->where('userId', $id)->first();
        return view('layout.nav', ['supervisor' => $supervisor, 'magang'=>$magang]);
    }
}