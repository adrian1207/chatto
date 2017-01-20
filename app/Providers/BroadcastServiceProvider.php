<?php

namespace chatto\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        Broadcast::channel('presence', function ($user)
        {
            if (\Auth::check())
            {
                return [
                    'id' => $user->id,
                    'gender' => $user->gender,
                    'nick' => $user->nick,
                    'age' => $user->age,
                    'about' => $user->about,
                    'interests' => $user->interests,
                    'region' => $user->region,
                    'photo' => $user->photo
                ];
            }
        });

        Broadcast::channel('priv-*-*', function ($user, $sender, $recipient)
        {
            if ($user->id == $sender || $user->id == $recipient)
            {
                return [
                    'id' => $user->id,
                    'gender' => $user->gender,
                    'nick' => $user->nick,
                    'age' => $user->age,
                    'about' => $user->about,
                    'interests' => $user->interests,
                    'region' => $user->region,
                    'photo' => $user->photo
                ];
            }
        });
    }
}
