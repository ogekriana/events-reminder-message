<?php

namespace SimpleProject\Http\Controllers;

use Illuminate\Http\Request;
use SimpleProject\Http\Controllers;
use SimpleProject\Http\Requests;
use SimpleProject\Event;
use SimpleProject\User;
use Response;

class EventsController extends Controller
{
    public function index(){
    	$events = Event::all();
    	return Response::json(['message' => $events], 200);
    }

    public function show($id){
    	$event = Event::with(
            array('users'=>function($query){
                $query->select('id','name');
                //var_dump($query);die();
            })
            )->find($id);
		//$event = Event::with('users')->find($id);

    	if(!$event){
    		return Response::json([
    			'error' => [
    				'message' => 'Event doesn\'t exist'
    			]
    		], 404);
    	}

    	return Response::json(['data' => $event], 200);
    }

    public function store(Request $request){

        $rules = array(
            'user_id' => 'required',
            'date' => 'required | date_format:Y-m-d ',
            'title' => 'required',
        );
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Response::json([
                'error' =>[
                    $validator->errors()
                ]
            ],422);
        }else{
            $event = Event::create($request->all());

            return Response::json([
                    'message' => 'Event Created Succesfully',
                    'data' => $event
            ]);
        }       
    }

    public function update(Request $request, $id){
        //var_dump($request->input('date'));die;
        $rules = array(
            'user_id' => 'required',
            'date' => 'required | date_format:Y-m-d',
            'title' => 'required',
        );
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Response::json([
                'error' =>[
                    $validator->errors()
                ]
            ],422);
        }else{
            $event = Event::find($id);
            $event->user_id = $request->user_id;
            $event->date = $request->date;
            $event->title = $request->title;
            $event->description = $request->description;
            $event->save();

            return Response::json([
                    'message' => 'Event Updated Succesfully',
                    'data' => $event
            ]);
        }       
    }

    public function destroy($id)
    {
        Event::destroy($id);
        return Response::make(['message' => 'Event Deleted Succesfully'], 410);
    }
}
