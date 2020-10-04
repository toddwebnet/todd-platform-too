<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserAppRole;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class AccountService
{

    public function getUserSessionVariables($email, $password)
    {
        $user = $this->getUserViaCredentials($email, $password);
        if ($user === null) {
            return null;
        }
        return [
            'user' => $user->toArray(),
            'person' => $user->person->toArray(),
            'roles' => $this->getUserPermissions($user->id)
        ];
    }

    public function getUserViaCredentials($email, $password)
    {
        try {
            return User::where([
                'email' => $email
            ])->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return null;
        }
        if (!Hash::check($password, $user->password)) {
            return null;
        }
        dd($user);
        return $user;
    }

    public function getUserPermissions($userId)
    {
        $roles = UserAppRole::where('user_app_roles.user_id', $userId)
            ->leftJoin('user_apps', 'user_app_roles.app_id', 'user_apps.app_id')
            ->leftJoin('apps', 'user_apps.app_id', 'apps.id')
            ->leftJoin('app_roles', 'user_app_roles.app_role_id', 'app_roles.id')
            ->select('app_code', 'app_name', 'app_url', 'role_code', 'role_name')
            ->get();

        $roleData = [];
        foreach ($roles as $role) {
            if (!array_key_exists($role->app_code, $roleData)) {
                $roleData[$role->app_code] = [
                    'app_name' => $role->app_name,
                    'app_url' => $role->app_url,
                    'roles' => []
                ];
            }
            $roleData[$role->app_code]['roles'][$role->role_code] = $role->role_name;
        }
        return $roleData;
    }
}
