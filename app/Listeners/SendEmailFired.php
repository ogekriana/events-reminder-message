<?php

namespace SimpleProject\Listeners;

use SimpleProject\Events\SendEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use SimpleProject\EventReminder;
use Mail;

class SendEmailFired
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
     * @param  SendEmail  $event
     * @return void
     */
    public function handle(SendEmail $event)
    {
        $reminder = EventReminder::with('event')->findOrFail($event->reminderId)->toArray(); 
        $reminder['content'] = $reminder['message'];
        //var_dump($reminder);die;
        Mail::send('emails.reminder_message', $reminder, function($message) use ($reminder) {
            $message->to($reminder['remind_to']);
            $message->subject('Event Reminder Testing');
        });
    }
}
