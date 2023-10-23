<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Laravel\Sanctum\NewAccessToken;
use Carbon\Carbon;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'ids';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'passwd',
        'dates',
        'is_activated',
        'cle_user',
        'departement_id',
        'usertype_id',
    ];

    protected $maps  = [
        'name' => 'nm',
        'username' => 'usrnm',
        'is_activated' => 'is_act',
        'cle_user' => 'cle_usr',
        'dates' => 'dt',
        'created_at' => 'dt_crt',
        'updated_at' => 'dt_upd',
        'departement_id' => 'dp_id',
        'usertype_id' => 'usr_t_id',
    ];

    protected $appends = [
        'nm',
        'usrnm',
        'is_act',
        'cle_usr',
        'dt',
        'dt_crt',
        'dt_upd',
        'dp_id',
        'usr_t_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'passwd',
        'name',
        'username',
        'is_activated',
        'cle_user',
        'departement_id',
        'usertype_id',
        'created_at',
        'updated_at',
        'dates'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
        'passwd' => 'hashed',
    ];


    /**
     * Create a new personal access token for the user.
     *
     * @param  string  $name
     * @param  array   $abilities
     * @param  Carbon  $date
     * @return \Laravel\Sanctum\NewAccessToken
     */
    public function createToken(string $name, array $abilities = ['*'], Carbon $date = null)
    {
        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken = Str::random(240)),
            'abilities' => $abilities,
            'expires_at' => $date
        ]);

        // return new NewAccessToken($token, $token->getKey().'|'.$plainTextToken);
        return new NewAccessToken($token, $plainTextToken);
    }


    public function getNmAttribute() {
        return $this->attributes['name'];
    }
    public function getUsrnmAttribute() {
        return $this->attributes['username'];
    }
    public function getIsActAttribute() {
        return $this->attributes['is_activated'];
    }
    public function getCleUsrAttribute() {
        return $this->attributes['cle_user'];
    }
    public function getDtAttribute() {
        return $this->attributes['dates'];
    }
    public function getDtCrtAttribute() {
        return $this->attributes['created_at'];
    }
    public function getdtUpdAttribute() {
        return $this->attributes['updated_at'];
    }

    public function getDpIDAttribute() {
        return $this->attributes['departement_id'];
    }
    public function getUsrTIdAttribute() {
        return $this->attributes['usertype_id'];
    }

    /**
     * RELATION TABLE
     */
    public function userType(): HasOne {
        return $this->belongsTo(UserTypes::class, 'usertype_id');
    }

    public function departement(): HasOne {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    public function allPositions(): BelongsTo {
        return $this->hasMany(AllPositions::class);
    }
}
