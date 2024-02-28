<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pemagang extends Model
{
    use HasFactory;

    // use HasApiTokens, HasFactory, Notifiable;
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'tblPemagang';

    
    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'supervisorId');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

    protected $fillable = [
        'userId',
        'supervisorId',
        'kelompokId',
        'namaPemagang',
        'namaUniversitas',
        'tglMulai',
        'tglSelesai',
        'fotoProfil',
        'noTelp'
    ];
    
    protected $hidden = [
        'noTelp',
        'timestamps',
    ];
 
    // protected $dateFormat = 'U';
    protected $casts = [
        'tglMulai' => 'datetime',
        'tglSelesai' => 'datetime',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(Pemagang::class, 'pemagangId');
    // }


}