<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;


    protected $primaryKey = 'ids';


    public function departement(): BelongsTo {
        return $this->belongsTo(Departement::class, 'site_id');
    }

    public function users():BelongsTo {
        return $this->hasMany(User::class);
    }
}
