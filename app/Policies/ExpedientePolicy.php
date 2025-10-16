<?php

namespace App\Policies;

use App\Models\Expediente;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExpedientePolicy
{
    use HandlesAuthorization;

    /**
     * Determina si el usuario puede actualizar el expediente
     */
    public function update(User $user, Expediente $expediente): bool
    {
        // Admin puede actualizar cualquier expediente
        if ($user->rol->nombre === 'Administrador') {
            return true;
        }

        // Usuario normal solo puede actualizar sus propios expedientes
        return $expediente->id_usuario_registra === $user->id;
    }

    /**
     * Determina si el usuario puede eliminar el expediente
     */
    public function delete(User $user, Expediente $expediente): bool
    {
        // Solo admin puede eliminar
        return $user->rol->nombre === 'Administrador' || $user->id === $expediente->id_usuario_registra;
    }

    /**
     * Determina si el usuario puede ver un expediente eliminado
     */
    public function viewDeleted(User $user, Expediente $expediente): bool
    {
        return $user->rol->nombre === 'Administrador';
    }

    public function restore(User $user, Expediente $expediente)
{
    return $user->rol->nombre === 'Administrador';
}

}
