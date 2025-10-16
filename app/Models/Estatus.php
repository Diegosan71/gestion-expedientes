<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estatus extends Model
{
    protected $table = 'estatus';
    protected $fillable = ['nombre'];

    public function expedientes()
    {
        return $this->hasMany(Expediente::class, 'id_estatus');
    }
}
