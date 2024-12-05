<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialLoginController extends Controller
{
    //
    public function redirectSocialLogin(Request $request) {
        $socialType = $request->social;
        return Socialite::driver($socialType)->redirect();
    }

    public function processSocialLogin(Request $request) {
        $socialType = $request->social;
        $userSocialData = Socialite::driver($socialType)->user();
        if(!$userSocialData) {
            return;
        }
        $user = User::updateOrCreate([
            "{$socialType}_id" => $userSocialData->id,
        ], [
            'name' => $userSocialData->name,
            'email' => $userSocialData->email,
            'username' => "user_$userSocialData->id",
            "{$socialType}_id" => $userSocialData->id,
        ]);

        Auth::login($user);

        return redirect('/home');
    }
}
