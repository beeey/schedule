<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Schedule;
use App\SocialUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Throwable
     */
    public function handleGoogleCallback(Request $request)
    {
        $googleUser = Socialite::driver('google')->user();

        $socialUser = SocialUser::firstOrNew([
            'social_type' => 'google',
            'social_id' => $googleUser->getId(),
        ], [
            'nick_name' => $googleUser->getNickname(),
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'avatar_url' => $googleUser->getAvatar()
        ]);

        if ($socialUser->exists) {
            $socialUser->save();
            return redirect('/');
        }

        DB::transaction(function () use ($socialUser) {
            $user = new User();
            $user->forceFill(['name' => $socialUser->name])->save();
            $socialUser->user()->associate($user)->save();
        });

        return redirect('/');
    }


}
