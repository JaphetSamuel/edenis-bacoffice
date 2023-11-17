<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'phone',
        'is_active',
        'parrain_id',
        'parrain_code',
        'etape',
        'kyc',
        'stripe_customer_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function portefeuille()
    {
        return $this->hasOne(Portefeuille::class);
    }

    public function parrain()
    {
        return $this->belongsTo(User::class, 'parrain_id');
    }

    public function filleuls(): HasMany
    {
        return $this->hasMany(User::class, 'parrain_id');
    }

    public function genererCodeParrain()
    {
        if ($this->parrain_code) {
            return;
        }
        $code = strtoupper(substr($this->name, 0, 3) . substr($this->phone, 0, 3) . substr($this->email, 0, 3));
        $code = $code . rand(100, 999);
        $this->parrain_code = $code;
        $this->save();
    }

    public function allName(){
        return $this->name . ' ' . $this->lastname;
    }

}
