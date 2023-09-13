<?php

namespace App\Http\Repositories;
use App\Http\Interfaces\AuthenticationInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthenticationRepository  implements AuthenticationInterface
{

    public function __construct()
    {
    }

    public function show()
    {
        return view('auth.login');
    }

    public function login($request)
    {

        $credentials= $request->getCredentials();

        if(!Auth::validate($credentials)):
            return redirect()->to('login')
                ->with('error',translate('Authentication failed. Please check your email  or password'));
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);


        return redirect('dashboard');
    }


    /**
     * Handle response after user authenticated
     *
     * @param Request $request
     * @param Auth $user
     *
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended('dashboard');
    }


    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
