<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $primaryKey = 'ids';

    protected $fillable = [
        'departement_id',
        'status_vehicle_id',
        'name',
    ];

    protected $maps  = [
        'departement_id' => 'dp_id',
        'status_vehicle_id' => 'st_vh_id',
        'name' => 'nm',
    ];

    protected $appends = [
        'dp_id',
        'st_vh_id',
        'nm',
    ];

    protected $hidden = [
        'departement_id',
        'status_vehicle_id',
        'name',
        'created_at',
        'updated_at',
    ];

    public function getDpIdAttribute() {
        return $this->attributes['departement_id'];
    }
    public function getStVhIdAttribute() {
        return $this->attributes['status_vehicle_id'];
    }
    public function getNmAttribute() {
        return $this->attributes['name'];
    }


    public function departement(): HasOne {
        return $this->belongsTo(Departement::class, 'departement_id');
    }
    public function status(): HasOne {
        return $this->belongsTo(Status::class, 'status_vehicle_id');
    }
    public function allPositions(): BelongsTo {
        return $this->hasMany(AllPositions::class);
    }

}
