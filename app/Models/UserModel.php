<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import the correct BelongsTo class

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'm_user'; // Defining the table name
    protected $primaryKey = 'user_id'; // Defining the primary key

    protected $fillable = ['level_id', 'username', 'nama', 'password'];

    // Defining the relationship with LevelModel
    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
}
