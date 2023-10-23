<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $primaryKey = 'ids';

    public function status(): HasOne {
        return $this->belongsTo(Status::class, 'real_maintenance_status_id');
    }

}
