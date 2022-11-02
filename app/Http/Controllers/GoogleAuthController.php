<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class GoogleAuthController extends Controller
{
    public function RespondCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $users = User::where('google_id',$user->id)->first();
            if ($users) {
                Auth::login($users);
                return redirect()->route('dashboard');
            }else{
                $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id' => $user->id,
                        'level'=> 2,
                        'password'=> encrypt(config('services.default.emergency')),
                ]);
                Auth::login($newUser);
                return redirect()->route('dashboard');

            }
        } catch (Exception $e) {
                dd($e->getMessage());
        }
    }
}
