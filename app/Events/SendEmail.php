<?php

namespace SimpleProject\Events;

use SimpleProject\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendEmail extends Event
{
    use SerializesModels;
    public $reminderId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($reminderId)
    {
        $this->reminderId = $reminderId;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
