<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        // Solo el primer usuario (admin) puede ver el listado de usuarios
        return $user->id === 1;
    }

    public function view(User $user, User $model): bool
    {
        // El usuario puede ver su propio perfil o el admin puede ver cualquiera
        return $user->id === $model->id || $user->id === 1;
    }

    public function create(User $user): bool
    {
        // Solo el admin puede crear usuarios
        return $user->id === 1;
    }

    public function update(User $user, User $model): bool
    {
        return false;
    }

    public function delete(User $user, User $model): bool
    {
        // Solo el admin puede eliminar usuarios y no puede eliminarse a sí mismo
        return $user->id === 1 && $user->id !== $model->id;
    }

    public function restore(User $user, User $model): bool
    {
        return false;
    }

    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
