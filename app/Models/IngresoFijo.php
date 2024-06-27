<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IngresoFijo extends Model
{
    use HasFactory;
    
    //tabla asociada
    protected $table = 'ingreso_fijo';
    
    //campos CRUD asociados a ORM
    protected $fillable = [
        'user_id',
        'concepto',
        'cantidad',
    ];

    //RELACION CON MODELOS

    /* Relación inversa con modelo user*/
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}


