<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Exception;
use App\User;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Create a new controller instance.s
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();

            if(explode("@", $user->email)[1] !== 'my.jru.edu'){
                return redirect()->route('StudentLogin');
            }

            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect()->route('Dashboard');

            }else{
                $newUser = User::create([
                    'firstname' => $user->user['given_name'],
                    'lastname' => $user->user['family_name'],
                    'email' => $user->email,
                    'google_id'=> $user->id,
                ]);

                Auth::login($newUser);

                return redirect()->route('Dashboard');

            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
