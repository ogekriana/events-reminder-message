<?php

namespace SimpleProject;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['user_id', 'date', 'title', 'description'];
}
