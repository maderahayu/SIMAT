<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $primaryKey = 'tugasId';

    protected $table = 'tblTugas';

    public function logbook()
    {
        return $this->hasMany(Logbook::class);
    }

    public function evaluation()
    {
        return $this->hasOne(Evaluation::class);
    }

    protected $fillable = [
        'judul', 
        'deskripsi',
        'tglMulai',
        'tglSelesai',
        'kelompokId',
        'supervisorId',
        'tglMulai',
        'tglSelesai',
        'status'

    ];
 
    protected $hidden = [
        'timestamps',
    ];
}
