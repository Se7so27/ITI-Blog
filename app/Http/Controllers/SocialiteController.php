<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        $githubUser = Socialite::driver('github')->user();

        $user = User::firstOrCreate(
            ['email' => $githubUser->email],
            [
                'name'     => $githubUser->name ?? $githubUser->nickname,
                'password' => bcrypt(str()->random(24)),
            ]
        );

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
