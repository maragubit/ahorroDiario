<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'email',
        'password',
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
    ];

    
    //RELACIONES ENTRE MODELOS

    /*Relación user con modelo ingreso */
    public function ingresos(): HasMany 
    {
        return $this->hasMany(Ingreso::class);
    }

    /*Relación user con modelo gasto */
    public function gastos(): HasMany
    {
        return $this->hasMany(Gasto::class);
    }

    /*Relación user con modelo gasto_fijo */
    public function gastosFijos(): HasMany
    {
        return $this->hasMany(GastoFijo::class);
    }

    /*Relación user con modelo ingreso_fijo */
    public function ingresosFijos(): HasMany
    {
        return $this->hasMany(IngresoFijo::class);
    }

    /*Relación user con modelo ahorro */
    public function ahorro(): HasMany
    {
        return $this->hasMany(Ahorro::class);
    }
}
