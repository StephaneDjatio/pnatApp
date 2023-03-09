<?php


namespace App\Services\User;
use App\Http\Requests\UpdateUserRequest;

use App\Models\User;

class UserUpdatorService
{
    public static function update(UpdateUserRequest $request, $id) {
        User::where('id', $id)->update($request->only('name', 'email', 'is_admin'));
    }

    public static function changePassword($newPassword, $id) {
        User::where('id', $id)->update(['password' => bcrypt($newPassword)]);
    }
}
