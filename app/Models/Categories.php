<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';


    protected $fillable = [
        'id',
        'tipus',
        'reparador_id', 
    ];
    public function reparador()
    {
        return $this->belongsTo(Reparadors::class, 'reparador_id');
    }
}
