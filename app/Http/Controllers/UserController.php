<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    
    public function create(){
        return view('users.register');
    }

    public function store(Request $req){

        $formFields = $req -> validate([
            'name' => ['required' , 'min:3'],
            'email' => ['required' , 'email' , Rule::unique('users','email')],
            'password' => ['required' , 'confirmed' , 'min:6'],

        ]); 


        // Hash Password

        $formFields['password'] = bcrypt($formFields['password']);
        $user = User::create($formFields);

        auth() -> login($user);
        return redirect('/') -> with('message' , 'Welcome');


    }

    public function login(){
        return view('users.login');
    }

    public function logout(){
        auth()->logout();
        return redirect('/login');
    }

    public function authenticate(Request $req){

        
        $formFields = $req -> validate([
            'email' => ['required' , 'email'],
            'password' => ['required'],

        ]); 

        if(auth() -> attempt($formFields)){
            $req -> session() -> regenerate();
            return redirect('/')->with('message' , 'Welcome Back');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');

    }

}
