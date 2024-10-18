<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class AuthController extends Controller
{
    //Register User
    public function register(Request $request) {

        //validate

     $fields = $request->validate([
        'username' => ['required', 'max:255'],
        'email' => ['required', 'max:255', 'email', 'unique:users'],
        'password' => ['required', 'min:3', 'confirmed']
    ]);
 
        //register

    $user = User::create($fields);

        //login
    Auth::login($user);

    event(new Registered($user));
    
        //redirect
    return redirect()->route('dashboard');
    
    }

    //Verify Email notice handler
    public function verifyNotice (){
        return view('auth.verify-email');
    }

     //Email verification Handle

    public  function verifyEmail (EmailVerificationRequest $request) {
        $request->fulfill();
     
        return redirect()->route('dashboard');
    }

    //Resending the Verification Email route
    public function verifyHandler (Request $request) {
        $request->user()->sendEmailVerificationNotification();
     
        return back()->with('message', 'Verification link sent!');
    }

    //For Login the user

    public function login(Request $request){
    $fields = $request->validate([
        'email' => ['required', 'max:255', 'email'],
        'password' => ['required']
    ]);


    //Try to login the user

        if (Auth::attempt($fields, $request->remember)){
        return redirect()->intended('dashboard');

        }else{
        return back()->withErrors([
            'failed' => 'The provide credentials do not match our records.'
        ]);
     }
    }

    //Logout

    public function logout(Request $request){
       //Logout User
        Auth::logout();
        
        //Invalidate users sessions
        $request->session()->invalidate();

        //Regenerate CSRF token
        $request->session()->regenerateToken();
        //Redirect to Home
        return redirect('/');


    }
}
