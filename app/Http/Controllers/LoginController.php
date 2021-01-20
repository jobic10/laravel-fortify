<?php

namespace App\Http\Controllers;
use Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function github(){
        //Send User's Request to GitHub
        return Socialite::driver('github')->redirect();
    }

    public function githubRedirect(){
        //Get Oauth back from github authentication
        $github = Socialite::driver('github')->user();
        //if this user does not exist, add
        //If they do, get the model
        // Either way, authenticate the user and redirect
        $user = User::firstOrCreate([
            'email' => $github->email
        ],[
            'name' => $github->name,
            'password' => '12345678',
            'username' => mt_rand(1,22222222)
        ]);
        Auth::login($user, true);
        return redirect('/home');
    }
}
