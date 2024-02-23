<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencies extends Model
{
    use HasFactory;
    protected $table = 'incidencies';


    protected $fillable = [
        'titol',
        'descripcio',
        'data',
        'hora',
        'estat',
        'lloc',
        'user_id',
        'categoria_id',
    ];
    public function category()
    {
        return $this->belongsTo(Categories::class, 'categories_id');
    }

}
