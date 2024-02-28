<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelompok extends Model
{
    use HasFactory;
    protected $table = 'tblKelompok';

    protected $fillable = [
        'namaKelompok',
        'supervisorId'
    ];
 
    protected $hidden = [
        'timestamps',
    ];

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'supervisorId');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
}
