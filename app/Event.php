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
}
