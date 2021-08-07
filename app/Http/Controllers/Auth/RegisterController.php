<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    protected $redirectTo = RouteServiceProvider::PAINEL;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register() 
    {
        return view('admin.auth.register');
    }

    public function registerAction(Request $request)
    {
        $data = $request->only([
            'name',
            'email',
            'password',
            'password_confirmation'
        ]);

        $validator = $this->validator($data);

        if($validator->fails())
        {
            return redirect()
                   ->back()
                   ->withInput()
                   ->withErrors($validator);
        } 

        else 
        {
            $user = $this->create($data);
            Auth::login($user);

            return view('admin.auth.login');
        }
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', 'unique:users', 'string'],
            'password' => ['required', 'confirmed', Password::defaults()]
        ]);
    }

    protected function create(Array $data) 
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }
}
