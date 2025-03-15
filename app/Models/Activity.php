<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'description'
    ];

    /**
     * Mendapatkan user yang melakukan aktivitas
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendapatkan admin yang melakukan aktivitas
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }

    /**
     * Mendapatkan superadmin yang melakukan aktivitas
     */
    public function superadmin(): BelongsTo
    {
        return $this->belongsTo(Superadmin::class, 'user_id');
    }

    /**
     * Mendapatkan user yang melakukan aktivitas (polymorphic)
     */
    public function actor()
    {
        if ($this->superadmin()->exists()) {
            return $this->superadmin;
        } elseif ($this->admin()->exists()) {
            return $this->admin;
        }
        return $this->user;
    }
} 