<?php

namespace App\Listeners;

use App\Models\Ticket;
use App\Events\UpdateTicketStatus;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateTicketStatusListener
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
     * @param  \App\Events\UpdateTicketStatus  $event
     * @return void
     */
    public function handle(UpdateTicketStatus $event)
    {
        Ticket::where('status_id', $event->ticketStatus->id)->update(['status_id' => $event->ticketStatus->id]);
    }
}
