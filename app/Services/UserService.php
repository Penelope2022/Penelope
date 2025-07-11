<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function create(array $data, ?string $role = null): User
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        if ($role) {
            $user->assignRole($role);
        }
        return $user;
    }
}
