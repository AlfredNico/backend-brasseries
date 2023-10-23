<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'ids';

    protected $fillable = [
        'name',
    ];

    protected $maps  = [
        'name' => 'nm',
    ];

    protected $appends = [
        'nm',
    ];

    protected $hidden = [
        'name',
    ];

    public function getNmAttribute() {
        return $this->attributes['name'];
    }

    /**
     * RELATION TABLE
     */
    public function departements(): BelongsTo {
        return $this->hasMany(Departement::class);
    }
}
