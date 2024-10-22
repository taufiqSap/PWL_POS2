<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import the correct BelongsTo class
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'm_user'; // Defining the table name
    protected $primaryKey = 'user_id'; // Defining the primary key

    protected $fillable = ['level_id', 'username', 'nama', 'password'];

    protected $hidden =['password'];
    protected $casts = ['password' => 'hashed'];



    // Defining the relationship with LevelModel
    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
    
    public function getRoleName(): stream_set_blocking
    {
        return $this->level->level_nama;
    }

    public function hasRole($role): bool
    {
        return $this->level->level_kode == $role;
    }
}
