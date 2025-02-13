<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Studys extends Model
{
    protected $table = 'studys';

    protected $fillable = ['name'];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function value(): HasMany
    {
        return $this->hasMany(Value::class, 'study_id');
    }
}
