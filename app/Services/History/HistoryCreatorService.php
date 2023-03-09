<?php


namespace App\Services\History;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserHistory;


class HistoryCreatorService
{
    public static function create($tasks) {
        UserHistory::create(
            [
                'user_id' => Auth::user()->id,
                'tasks' => $tasks
            ]
        );
    }

}
