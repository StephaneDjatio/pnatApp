<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginUserRequest;
use App\Services\User\UserAuthentificatorService;

class LoginController extends Controller
{
    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginPage() {
        return view('admin.login');
    }

    public function login(LoginUserRequest $request)
    {
        $input = $request->all();

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (UserAuthentificatorService::isAllowedToAccessAdmin(auth()->user())) {
                return redirect()->route('admin.home');
            }else{
                return redirect()->route('admin.home');
            }
        }else{
            return redirect()->route('login')
                ->withMessage('Email-Address And Password Are Wrong.');
        }

    }

    /**
     * Log out account user.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function perform_logout()
    {
        Session::flush();

        Auth::logout();

        return redirect()->route('users.logout');
    }
}
