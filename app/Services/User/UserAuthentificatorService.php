<?php


namespace App\Services\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

use App\Models\User;

class UserAuthentificatorService
{

    public static function isAllowedToAccessAdmin(User $user): bool
    {
        // dd($user->is_admin);
        return $user->is_admin;
    }
}
