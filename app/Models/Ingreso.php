<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ingreso extends Model
{
    use HasFactory;
    protected $table="ingreso";
    
    //campos CRUD asociados a ORM
    protected $fillable = [
        'user_id',
        'concepto',
        'cantidad',
        'created_at',
    ];
    
    //RELACION CON MODELOS

    /* Relación inversa con modelo user*/
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
