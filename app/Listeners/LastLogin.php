<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LastLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handleLogin(Login $in_event)
    {

    }
    public function handleLogout(Logout $out_event)
    {
        //Update user last login date/time
        $out_event->user->last_login = date('Y-m-d H:i:s');
        $out_event->user->save();
    }
}
