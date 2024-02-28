<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PemagangController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\LogbookController;
use App\Models\Pemagang;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
//Anak Magang Routes List
Route::middleware(['auth', 'user-access:pemagang'])->group(function () {
    Route::get('/magang/home', [HomeController::class, 'index'])->name('home');
    
    Route::get('/magang/tugas/index', [TugasController::class, 'indexTugasMagang'])->name('tugasIndex');
    Route::get('/magang/tugas/show/{id}', [TugasController::class, 'showTugasMagang'])->name('tugasShow');

    Route::get('/magang/logbook/index', [LogbookController::class, 'index'])->name('logbookIndex');
    Route::get('/magang/logbook/create', [LogbookController::class, 'createLogbook'])->name('logbookCreate');
    Route::post('/magang/logbook/store', [LogbookController::class, 'storeLogbook'])->name('logbookStore');
    Route::get('/magang/logbook/edit/{id}', [LogbookController::class, 'editLogbook'])->name('logbookEdit');
    Route::put('/magang/logbook/update/{id}', [LogbookController::class, 'updateLogbook'])->name('logbookUpdate');
    Route::get('/magang/logbook/delete/{id}', [LogbookController::class, 'deleteLogbook'])->name('logbookDelete');
});
//Supervisor Route List
Route::middleware(['auth', 'user-access:supervisor'])->group(function () {
    Route::get('/supervisor/home', [HomeController::class, 'supervisorHome'])->name('supervisor.home');
    Route::get('/supervisor/hakAksesMagang/index', [PemagangController::class, 'createPemagang'])->name('createPemagang');
    Route::post('/supervisor/hakAksesMagang/create', [PemagangController::class, 'createPemagangAkun'])->name('sup.buatAkunAnakMagang');

    Route::get('/supervisor/daftarAnakMagang/index', [SupervisorController::class, 'daftarAnakMagang'])->name('daftarAnakMagang');
    Route::get('/supervisor/daftarAnakMagang/edit/{id}', [SupervisorController::class, 'editAnakMagang'])->name('sup.editPemagang');
    Route::put('/supervisor/daftarAnakMagang/update/{id}', [SupervisorController::class, 'updateAnakMagang'])->name('sup.updateDataMagang');
    Route::get('/supervisor/daftarAnakMagang/delete/{id}', [SupervisorController::class, 'deleteAnakMagang'])->name('sup.deletePemagang');
    
    Route::get('/supervisor/evaluasi/index', [EvaluasiController::class, 'index'])->name('evaluasi.index');
    Route::get('/supervisor/evaluasi/create', [EvaluasiController::class, 'createEvaluasi'])->name('evaluasi.createEvaluasi');
    Route::post('/supervisor/evaluasi/store', [EvaluasiController::class, 'storeEvaluasi'])->name('evaluasi.storeEvaluasi');
    Route::get('/supervisor/evaluasi/edit/{id}', [EvaluasiController::class, 'editEvaluasi'])->name('editEvaluasi');
    Route::put('/supervisor/evaluasi/update/{id}', [EvaluasiController::class, 'updateEvaluasi'])->name('updateEvaluasi');
    Route::get('/supervisor/evaluasi/delete/{id}', [EvaluasiController::class, 'deleteEvaluasi'])->name('deleteEvaluasi');
    Route::get('/api/tugas/{taskId}', [EvaluasiController::class, 'getStatus']);
    Route::get('/api/kelompok/{interngroupId}', [EvaluasiController::class, 'show']);

    Route::get('/supervisor/kelompok', [KelompokController::class, 'index'])->name('kelompok.index');
    Route::get('/supervisor/kelompok/create', [KelompokController::class, 'createKelompok'])->name('createKelompok');
    Route::post('/supervisor/kelompok/store', [KelompokController::class, 'storeKelompok'])->name('storeKelompok');
    Route::get('/supervisor/kelompok/edit/{id}', [KelompokController::class, 'editKelompok'])->name('editKelompok');
    Route::put('/supervisor/kelompok/update/{id}', [KelompokController::class, 'updateKelompok'])->name('updateKelompok');
    Route::get('/supervisor/kelompok/delete/{id}', [KelompokController::class, 'deleteKelompok'])->name('deleteKelompok');

    Route::get('supervisor/tugas/index', [TugasController::class, 'index'])->name('task.index');
    Route::get('supervisor/tugas/create', [TugasController::class, 'create'])->name('task.create');
    Route::get('supervisor/tugas/edit/{id}', [TugasController::class, 'edit'])->name('task.edit');
    Route::post('supervisor/tugas/store', [TugasController::class, 'store'])->name('task.store');
    Route::put('supervisor/tugas/{tugas}', [TugasController::class, 'update'])->name('task.update');
    Route::get('supervisor/tugas/{tugas}', [TugasController::class, 'destroy'])->name('task.destroy');

});
