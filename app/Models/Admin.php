<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Admin extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;

    protected $fillable = ['name', 'email', 'password', 'gender', 'study'];

    // Jika Anda menggunakan hashing untuk password, pastikan untuk menambahkan ini
    protected $hidden = ['password', 'remember_token'];

    public function studys(): HasMany
    {
        return $this->hasMany(Studys::class);
    }
}
