<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;

    protected $primaryKey = 'ids';

    public function status(): HasOne {
        return $this->belongsTo(Status::class, 'status_disgnostic_id');
    }

}
