<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    protected $redirectTo = RouteServiceProvider::PAINEL;

    public function __construct() 
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginAction(Request $request)
    {
        $data = $request->only([
            'email',
            'password' 
        ]);

        $validator = $this->validator($data);

        if(!Auth::attempt($data)) { 

            $validator->errors()->add('password', 'Preencha os dados corretamente');

            return redirect()
                   ->back()
                   ->witErrors($validator);
        } else {

            return redirect()->route('panel.index');
        }
    }

    public function logout() {

        Auth::logout();

        return redirect()->route('login');
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'email', 'required', 'string'],
            'password' => ['required', 'string', Password::defaults()]
        ]);
    }
}
