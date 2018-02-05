<?php

namespace Fresh\Medpravda\Http\Controllers\Auth;

use Fresh\Medpravda\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;

class AuthController extends Controller
{
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

    protected $loginView;
    protected $decayMinutes = 1;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->loginView = 'auth.login';
    }

    /**
     * @return $this
     */
    public function showLoginForm()
    {
        $view = property_exists($this, 'loginView') ? $this->loginView : '';
        if (view()->exists($view)) {
            return view($view);
        }
        abort(404);
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * @param null $request
     * @param $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function authenticated($request = null, $user)
    {

        if (('admin' === $user->role->name) || ('editor' === $user->role->name)) {
            return redirect('admin');
        }

        if ('guest' === $user->role->name) {
            return redirect('/');
        }

        return redirect()->intended('--');
    }
}
