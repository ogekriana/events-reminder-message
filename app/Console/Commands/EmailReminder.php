<?php

namespace SimpleProject\Console\Commands;

use Illuminate\Console\Command;
use Event;
use SimpleProject\Events\SendEmail;
use SimpleProject\Http\Controllers\EventReminderController;

class EmailReminder extends Command
{
    public $reminder;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email Reminder Message';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->reminder = new EventReminderController();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $list = $this->reminder->getTodayReminders();
        foreach ($list as $key => $value) {
            Event::fire(new SendEmail($value->id));
            $this->info('Event reminder email sent');
        }
               
        
    }
}
