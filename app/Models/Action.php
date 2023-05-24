<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Action extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'user_ip', 'action_type', 'action_method', 'action_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
