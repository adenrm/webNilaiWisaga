<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Value extends Model
{
    protected $table = 'value';

    protected $fillable = [
        'user_id',
        'study_id',
        'value_dt1',
        'value_dt2',
        'value_mss',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function studys(): BelongsTo
    {
        return $this->belongsTo(Studys::class, 'id');
    }
}
