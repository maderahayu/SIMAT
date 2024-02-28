<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;

    protected $table = 'tblSupervisor';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelompok()
    {
        return $this->hasMany(kelompok::class, 'supervisorId');
    }

    public function magang()
    {
        return $this->hasMany(pemagang::class, 'supervisorId');
    }

    protected $fillable = [
        'namaSupervisor',
        'fotoProfil',
        'userId',
        'noTelp'
    ];
 
    protected $hidden = [
        'timestamps',
    ];
    // protected $dateFormat = 'd/m/Y';

 
    // protected $casts = [
    //     'tglMulai' => 'datetime',
    //     'tglSelesai' => 'datetime',
    // ];

}