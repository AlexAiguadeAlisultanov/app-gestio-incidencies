<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparadors extends Model
{
    use HasFactory;
    protected $table = 'reparadors';
    protected $fillable = ['nombre', 'apellidos', 'email', 'telefono', 'direccion', 'ciudad'];

}
