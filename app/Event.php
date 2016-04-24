<?php

namespace SimpleProject;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
    	'user_id', 'date', 'title', 'description'
    ];

    public function users(){
    	return $this->belongsTo('SimpleProject\User', 'user_id');
    }

    public function eventReminders(){
    	return $this->hasMany('SimpleProject\EventReminder', 'event_id');
    }
}
