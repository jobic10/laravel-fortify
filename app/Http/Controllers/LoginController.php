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
        $user = Socialite::driver('github')->user();
        dd($user);
    }
}
