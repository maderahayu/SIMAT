<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'userId',
        'nama',
        'email',
        'password',
        'type'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function magang()
    {
        return $this->hasMany(Pemagang::class, 'userId');
    }

    public function supervisor()
    {
        return $this->hasMany(Supervisor::class, 'userId');
    }

    public function kelompok()
    {
        return $this->hasOne(Kelompok::class);
    }

    // public function parentSupervisor()
    // {
    //     return $this->belongsTo(Supervisor::class, 'pemagangId');
    // }

    // public function parentPemagang()
    // {
    //     return $this->belongsTo(Pemagang::class, 'pemagangId');
    // }

    /**
     * Interact with the user's first name.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["pemagang", "supervisor"][$value],
        );
    }
}
