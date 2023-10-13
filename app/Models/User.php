<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Laravel\Sanctum\NewAccessToken;



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
        'is_activated',
        'cle_user',
        'departement_id',
        'usertype_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'passwd',
        // 'remember_token',
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

    public function userType(): HasOne {
        return $this->belongsTo(UserTypes::class, 'usertype_id');
    }

    public function departement(): HasOne {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    /**
     * Create a new personal access token for the user.
     *
     * @param  string  $name
     * @param  array  $abilities
     * @return \Laravel\Sanctum\NewAccessToken
     */
    public function createToken(string $name, array $abilities = ['*'], $date)
    {
        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken = Str::random(240)),
            'abilities' => $abilities,
            'expires_at' => $date
        ]);

        // return new NewAccessToken($token, $token->getKey().'.'.$plainTextToken);
        return new NewAccessToken($token, $plainTextToken);
    }
}
