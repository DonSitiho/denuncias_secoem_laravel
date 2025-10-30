<?php

namespace App\Policies;

use App\Models\Denuncia;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DenunciaPolicy
{
    /**
     * Permitir listar denuncias, 
     * solo si la denuncia esta turnada a una area y responsable en especifico y coincida con el usuario logueado 
     * o si tiene el rol Admin Denuncias.
     */
    public function viewAny(User $user): Response|bool
    {
        // Si el usuario tiene el rol "Admin Denuncias", devolver todas las denuncias
        if ($user->hasRole('Admin Denuncias')) {
            return true;
        }

        // Si el usuario tiene el rol "usuario-oic", solo puede ver las denuncias que se tiene asignado
        if ($user->hasRole('Usuario OIC')) {
            return true;
        }

        return Response::deny('No está autorizado para ver las denuncias, ya que no le ha sido asignada o no cuenta con los privilegios de administrador.');
    }

    /**
     * Permite ver los detalles de una denuncia
     * - Solo si el usuario tiene el rol de Admin Denuncias
     * - Solo si el usuario es el responsable al que se turno la denuncia
     * 
     */
    public function view(User $user, Denuncia $denuncia): Response|bool
    {
        // Si el usuario tiene el rol "Admin Denuncias", devolver todas las denuncias
        if ($user->hasRole('Admin Denuncias')) {
            return true;
        }

        if ($user->hasRole('Usuario OIC')) {
            
            $responsableId = $denuncia->id_responsable;
            
            if($user->id === $responsableId){
                return true;
            }
            
        }

        return Response::deny('No está autorizado para ver esta denuncia, ya que no le ha sido asignada o no cuenta con los privilegios de administrador.');

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Denuncia $denuncia): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Denuncia $denuncia): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Denuncia $denuncia): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Denuncia $denuncia): bool
    {
        //
    }
}
