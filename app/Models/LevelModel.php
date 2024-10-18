<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LevelModel extends Model
{
    protected $table = 'm_level'; // Specify the correct table name

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class);
    }
}
