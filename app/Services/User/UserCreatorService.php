<?php


namespace App\Services\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Services\History\HistoryCreatorService;

use App\Models\User;
use App\Models\UserHistory;

class UserCreatorService
{
    public static function create(StoreUserRequest $request) {
        User::create($request->only('name', 'email', 'password', 'is_admin'));
        HistoryCreatorService::create('created user '.$request->name);
    }
}
