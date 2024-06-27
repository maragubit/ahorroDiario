<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ahorro extends Model
{
    use HasFactory;
    protected $table ="ahorro";

     //campos CRUD asociados a ORM
     protected $fillable = [
        'user_id',
        'cantidad',
    ];

    //RELACION CON MODELOS

    /* Relación inversa con modelo user*/
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
