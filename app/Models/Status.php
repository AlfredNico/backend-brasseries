<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Status extends Model
{
    use HasFactory;

    protected $primaryKey = 'ids';

    protected $fillable = [
        'name',
        'type',
    ];

    protected $maps  = [
        'name' => 'nm',
        'type' => 'tp',
    ];

    protected $appends = [
        'nm',
        'tp',
    ];

    protected $hidden = [
        'name',
        'type',
        'created_at',
        'updated_at',
    ];

    public function getNmAttribute() {
        return $this->attributes['name'];
    }
    public function getTpAttribute() {
        return $this->attributes['type'];
    }


    /**
     * RELATION TABLE
     */
    public function vehicles(): BelongsTo {
        return $this->hasMany(Vehicle::class);
    }
    public function diagnostics(): BelongsTo {
        return $this->hasMany(Diagnostic::class);
    }
    public function maintenances(): BelongsTo {
        return $this->hasMany(Maintenance::class);
    }
    public function afterMaintenances(): BelongsTo {
        return $this->hasMany(ActionAfterMaintenance::class);
    }

}
