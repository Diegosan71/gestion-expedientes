<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expediente extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $fillable = [
        'numero_expediente',
        'asunto',
        'fecha_inicio',
        'id_estatus',
        'id_usuario_registra'
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario_registra');
    }

    public function estatus()
    {
        return $this->belongsTo(Estatus::class, 'id_estatus');
    }
}
