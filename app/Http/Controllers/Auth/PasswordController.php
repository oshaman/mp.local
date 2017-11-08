<?php

namespace Fresh\Medpravda\Http\Controllers\Auth;


use Illuminate\Foundation\Auth\ResetsPasswords;
use Fresh\Medpravda\Http\Controllers\Controller;

class PasswordController extends Controller
{
    use ResetsPasswords;
    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
