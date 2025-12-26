<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'iduser';
    protected $fillable = [
        'nama',
        'email',
        'password',
        'idrole',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }
<<<<<<< HEAD
    public function role()
    {
        return $this->belongsTo(Role::class, 'idrole', 'idrole');
    }
}
=======
    public function roleUser()
    {
        return $this->belongsTo(Role::class, 'idrole', 'idrole');
    }
}
>>>>>>> 308429d287be5371c618ffaede0d3a4b56b5ec16
