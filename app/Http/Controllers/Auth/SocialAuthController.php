<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Socialite;
use App\User;

class SocialAuthController extends Controller
{
     public function redirectToProvider($provider)
    {

		return Socialite::with($provider)->stateless()->redirect();    
	}
    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        // dd($user);
        // die;
        $authUser = User::firstOrNew(['provider_id' => $user->id]);

        $authUser->name = $user->name;
        $authUser->provider_id = $user->id;
        if(empty($user->name))
        	$authUser->name = $user->user['login'];
        $authUser->email = $user->email;
        $authUser->password = $user->user['login'].$user->id;
        if(empty($authUser))
        	$authUser->save();
    	auth()->login($authUser);
        Cache::put('key',$user->avatar, 60*60*24);
        return redirect('/dashboard');

	}
}
