<?php

namespace SimpleProject\Http\Controllers;

use Illuminate\Http\Request;
use SimpleProject\Http\Requests;
use SimpleProject\Event;
use Response;

class EventsController extends Controller
{
    public function index(){
    	$events = Event::all();
    	return Response::json(['message' => $events], 200);
    }

    public function show($id){
    	$event = Event::find($id);

    	if(!$event){
    		return Response::json([
    			'error' => [
    				'message' => 'Event doesn\'t exist'
    			]
    		], 404);
    	}

    	return Response::json(['data' => $event], 200);

    }
}
