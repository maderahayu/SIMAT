<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    protected $primaryKey = 'logbookId';

    protected $table = 'tblLogbook';

    public function task()
    {
        return $this->belongsTo(Tugas::class, 'tugasId');
    }

    public function evaluation()
    {
        return $this->belongsTo(Evaluasi::class, 'evaluasiId');
    }

    protected $fillable = [
        'pemagangId', 
        'tugasId',
        'deskripsi',
        'tglLogbook',
    ];
 
    protected $hidden = [
        'timestamps',
    ];
}
