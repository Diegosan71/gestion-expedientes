<?php

namespace App\Services;

use App\Models\Expediente;
use Illuminate\Support\Facades\Auth;

class ExpedienteService
{
    /**
     * Crear un nuevo expediente
     */
    public function crear(array $data): Expediente
    {
        $data['id_usuario_registra'] = Auth::id(); // usuario logueado
        return Expediente::create($data);
    }

    /**
     * Actualizar un expediente
     */
    public function actualizar(Expediente $expediente, array $data): bool
    {
        return $expediente->update($data);
    }

    /**
     * Borrar (soft delete) un expediente
     */
    public function eliminar(Expediente $expediente): bool
    {
        return $expediente->delete();
    }

    /**
     * Recuperar expedientes con filtros
     * $filtros = ['estatus' => 1, 'fecha_inicio_desde' => '2025-10-01', 'fecha_inicio_hasta' => '2025-10-31', 'busqueda' => '00001']
     */
    public function listar(array $filtros)
{
    $query = Expediente::query();

    if (Auth::user()->rol->nombre === 'Administrador') {
        // Admin: incluir expedientes eliminados
        $query->withTrashed();
    } else {
        // Usuario normal: solo sus propios expedientes activos
        $query->where('id_usuario_registra', Auth::id());
    }

    // Filtrar por estatus
    if (!empty($filtros['estatus'])) {
        $query->where('id_estatus', $filtros['estatus']);
    }

    // Filtrar por rango de fechas
    if (!empty($filtros['fecha_inicio_desde'])) {
        $query->where('fecha_inicio', '>=', $filtros['fecha_inicio_desde']);
    }
    if (!empty($filtros['fecha_inicio_hasta'])) {
        $query->where('fecha_inicio', '<=', $filtros['fecha_inicio_hasta']);
    }

    // Búsqueda por número o asunto
    if (!empty($filtros['busqueda'])) {
        $query->where(function ($q) use ($filtros) {
            $q->where('numero_expediente', 'like', '%' . $filtros['busqueda'] . '%')
              ->orWhere('asunto', 'like', '%' . $filtros['busqueda'] . '%');
        });
    }

    return $query->orderBy('fecha_inicio', 'desc')->paginate(10);
}

}
