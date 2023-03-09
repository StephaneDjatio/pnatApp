<?php


namespace App\Services\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

use App\Models\User;

class UserSessionService
{

    public function invalidate(User $user): void
    {

    }
}
