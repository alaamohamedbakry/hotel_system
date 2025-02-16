<?php

namespace App\Concerns;

use App\Models\Role;

trait HasRoles
{
    public function roles()
    {
        return $this->morphToMany(Role::class, 'authorizable', 'role_user');
    }

    public function haspremission($premission)
    {

        $denied = $this->roles()->whereHas('premissions', function ($query) use ($premission) {
            $query->where('premission', $premission)
                ->where('type', '=','deny');
        })->exists();

        if($denied){
            return false;
        }


        return $this->roles()->whereHas('premissions', function ($query) use ($premission) {
            $query->where('premission', $premission)
                ->where('type', '=','allow');
        })->exists();
    }
}
