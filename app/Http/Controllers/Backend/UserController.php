<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\User\UserCreatorService;
use App\Services\User\UserUpdatorService;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('adminHome');
    }

    /**
     * Show the application List user interface.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function listUsers() {

        $users = User::get();

        return view('admin.list_users', ['users' => $users]);
    }

    /**
     * Show the application List users history interface.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function listUsersHistory() {
        return view('admin.users_histories');
    }

    /**
     * Show the application new user interface.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function create() {
        return view('admin.new_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreUserRequest $request) {

        UserCreatorService::create($request);

        return redirect()->route('users.list')->withMessage('New user created.');
    }

    /**
     * Get unique user by id.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response json
     */

    public function show(Request $request) {

        $user = User::findOrFail($request->id);

        return json_encode($user);
    }

    /**
     * Update a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateUserRequest $request) {

        UserUpdatorService::update($request, $request->id);

        return redirect()->route('users.list')->withMessage('User data updated.');
    }


    /**
     * Update a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function resetPassword(Request $request)
    {

        UserUpdatorService::changePassword($request->password, $request->id);

        return redirect()->route('users.list')->withMessage('User password reserted.');
    }
}
