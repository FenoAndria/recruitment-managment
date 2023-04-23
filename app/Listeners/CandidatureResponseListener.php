<?php

namespace App\Listeners;

use App\Events\CandidatureResponseEvent;
use App\Mail\CandidatureResponseMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\JsonResponse;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class CandidatureResponseListener
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
     * @param  \App\Events\CandidatureResponseEvent  $event
     * @return void
     */
    public function handle(CandidatureResponseEvent $event)
    {
        Mail::send(new CandidatureResponseMail($event->candidature));
    }
}
