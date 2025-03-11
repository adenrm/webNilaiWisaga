<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Value extends Model
{
    protected $table = 'value';

    protected $fillable = [
        'user_id',
        'studys_id',
        'study',
        'value_dt1',
        'value_dt2',
        'value_mss',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function studys(): HasOne
    {
        return $this->hasOne(Studys::class, 'id');
    }
}