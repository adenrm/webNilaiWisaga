<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Study extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'studys';

    protected $fillable = [
        'name',
        'code',
        'description',
        'status'
    ];

    public function values()
    {
        return $this->hasMany(Value::class, 'studys_id');
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_study')
                    ->withPivot('study_name', 'status')
                    ->withTimestamps();
    }
} 