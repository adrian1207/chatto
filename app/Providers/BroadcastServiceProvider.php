<?php

namespace nuta\Providers;

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

        Broadcast::channel('presence_channel', function ($user)
        {
            if (\Auth::check())
            {
                return ['id' => $user->id, 'nick' => $user->nick];
            }
        });
    }
}
