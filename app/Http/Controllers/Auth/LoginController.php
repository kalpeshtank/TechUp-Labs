<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;

class LoginController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/admin/dashboard';

    public function index() {
        return view('auth.login');
    }

    public function login(Request $request) {

        $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
                    'password' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->errors());
        }

        if (Auth::attempt(['email' => $request->email, 'password' => request('password')])) {
            $user = Auth::user();
            if ($user->is_active == 0) {
                \Auth::logout();
                session()->flash('login_error', "Can you please active your account");
                return redirect('login');
            }

            return redirect()->route('dashboard');
        } else {
            session()->flash('login_error', 'Invalid Credentials');
            return redirect('login');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function logout() {
        \Auth::logout();
        return redirect()->route('login');
    }

}
