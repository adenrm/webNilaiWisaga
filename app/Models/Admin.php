<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends AuthenticatableUser implements Authenticatable
{
    use HasApiTokens, HasFactory, AuthenticatableTrait, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'status',
    ];

    // Jika Anda menggunakan hashing untuk password, pastikan untuk menambahkan ini
    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function studies()
    {
        return $this->belongsToMany(Study::class, 'admin_study')
                    ->withPivot('study_name', 'status')
                    ->withTimestamps();
    }

    public function values()
    {
        return $this->hasMany(Value::class);
    }
}
