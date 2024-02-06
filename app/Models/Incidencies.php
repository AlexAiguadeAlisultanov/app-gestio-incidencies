<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencies extends Model
{
    use HasFactory;
    protected $table = 'incidencies';

    protected $fillable = ['nombre','descripcion', 'precio', 'stock', 'imagen']; 
}
