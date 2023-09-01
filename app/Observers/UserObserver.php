<?php

namespace App\Observers;

use App\Jobs\SendEmailUserRegisteredJob;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        // Job for the process send email
        SendEmailUserRegisteredJob::dispatch($user);
    }
}
