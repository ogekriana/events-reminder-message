<?php

namespace SimpleProject;

use Illuminate\Database\Eloquent\Model;

class EventReminder extends Model
{
    protected $fillable = ['event_id', 'remind_date', 'message', 'remind_to'];
}
