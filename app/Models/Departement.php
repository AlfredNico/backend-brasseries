<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $primaryKey = 'ids';

    protected $fillable = [
        'name',
        'site_id',
    ];

    protected $maps  = [
        'name' => 'nm',
        'site_id' => 'st_id',
    ];

    protected $appends = [
        'nm',
        'st_id',
    ];

    protected $hidden = [
        'name',
        'site_id',
        'created_at',
        'updated_at',
    ];

    public function getNmAttribute() {
        return $this->attributes['name'];
    }

    public function getStIdAttribute() {
        return $this->attributes['site_id'];
    }

    /**
     * RELATION TABLE
     */
    public function site(): BelongsTo {
        return $this->belongsTo(Site::class, 'site_id');
    }

    public function users():BelongsTo {
        return $this->hasMany(User::class);
    }
    public function vehicles():BelongsTo {
        return $this->hasMany(Vehicle::class);
    }
}
