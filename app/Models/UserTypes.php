<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTypes extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'userTypes';
    protected $primaryKey = 'ids';


    public function users(): BelongsTo {
        return $this->hasMany(User::class);
    }
}
