<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllPositions extends Model
{
    use HasFactory;

    protected $primaryKey = 'ids';

    protected $fillable = [
        'last_driver',
        'vehicle_id',
        'position_name',
        'longs',
        'lats',
        'dates',
        'odometer',
    ];

    protected $maps  = [
        'last_driver' => 'ls_dv',
        'vehicle_id' => 'vh_id',
        'position_name' => 'pst_nm',
        'longs' => 'lg',
        'lats' => 'lt',
        'dates' => 'dt',
        'odometer' => 'odmt',
    ];

    protected $appends = [
        'ls_dv',
        'vh_id',
        'pst_nm',
        'lg',
        'lt',
        'dt',
        'odmt',
    ];

    protected $hidden = [
        'last_driver',
        'vehicle_id',
        'position_name',
        'longs',
        'lats',
        'dates',
        'odometer',
        'created_at',
        'updated_at',
    ];

    public function getLsDvAttribute() {
        return $this->attributes['last_driver'];
    }
    public function getVhIdAttribute() {
        return $this->attributes['vehicle_id'];
    }
    public function getPstNmAttribute() {
        return $this->attributes['position_name'];
    }
    public function getLgAttribute() {
        return $this->attributes['longs'];
    }
    public function getLtAttribute() {
        return $this->attributes['lats'];
    }
    public function getDtAttribute() {
        return $this->attributes['dates'];
    }
    public function getOdmtAttribute() {
        return $this->attributes['odometer'];
    }


    /**
     * RELATION TABLE
     */
    public function last_driver(): HasOne {
        return $this->belongsTo(User::class, 'last_driver');
    }
    public function vehicle(): HasOne {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
