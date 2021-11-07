<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
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

            
            if(!Auth::id()) {
                
                $validator->errors()->add('email', 'Não existe email para este usuário');
                $validator->errors()->add('password', 'A senha não foi compatível');

                return redirect()
                       ->back()
                       ->withInput()
                       ->withErrors($validator);
            }

            return redirect()
                   ->back()
                   ->withInput()
                   ->withErrors($validator);
        } else {

            return redirect()->route('panel.index');
        }
    }

    public function logout() {

        $userId = User::where('id', Auth::id())->first();

        if($userId) {

            Auth::logout();
            return redirect()->route('login');
        } else {

            return redirect()->back();
        }

    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'email', 'required', 'string'],
            'password' => ['required', 'string', Password::defaults()]
        ],
        [
           'password.required' => 'Campo senha é obrigatório',
           'email.required' => 'Campo email é obrigatório',
           'email.email' => 'O Campo de email está no formato incorreto'
        ]);
    }
}
