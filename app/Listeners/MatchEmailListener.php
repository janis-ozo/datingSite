<?php

namespace App\Listeners;

use App\Events\MatchEvent;
use App\Mail\MatchEmail;
use App\Services\MatchHistoryService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;


class MatchEmailListener implements ShouldQueue
{
    use InteractsWithQueue;


    public function handle(MatchEvent $event)
    {
        MatchHistoryService::store($event->authUser,$event->user);

        Mail::to($event->authUser->email)
            ->queue(new MatchEmail($event->authUser,$event->user));

        Mail::to($event->user->email)
            ->queue(new MatchEmail($event->user,$event->authUser));
    }
}
