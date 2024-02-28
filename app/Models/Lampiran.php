<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lampiran extends Model
{
    use HasFactory;

    protected $primaryKey = 'lampiranId';

    protected $table = 'tblLampiran';

    protected $fillable = [
        'userId', 
        'tugasId',
        'namaFile'
    ];
 
    protected $hidden = [
        'timestamps',
    ];
}
