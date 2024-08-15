<?php

namespace App\Listeners;

use App\Events\UserEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event
     * @param UserEvent $userEvent
     */
    public function handle(UserEvent $userEvent): void
    {
        Log::debug("User: {$userEvent->username} // action: {$userEvent->action}");
    }
}
