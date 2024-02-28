<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    use HasFactory;
    protected $primaryKey = 'evaluasiId';

    protected $table = 'tblEvaluasi';

    public function internGroup()
    {
        return $this->belongsTo(kelompok::class);
    }
    public function task()
    {
        return $this->belongsTo(Tugas::class, 'tugasId');
    }

    public function logbook()
    {
        return $this->hasMany(Logbook::class, 'logbookId');
    }    

    protected $fillable = [
        'penilaian',
        'komentar',
        'status',
        'tglEvaluasi',
        'tugasId',
        'kelompokId',
        'supervisorId',
    ];
 
    protected $hidden = [
        'timestamps',
    ];
}
