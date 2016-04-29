<?php

namespace SimpleProject\Http\Controllers;

use Illuminate\Http\Request;
use SimpleProject\Http\Controllers;
use SimpleProject\Http\Requests;
use SimpleProject\Event;
use SimpleProject\EventReminder;
use Response;

class EventReminderController extends Controller
{

    public function index(Request $request){
        
        return view('reminder')->with('event', $request->event);
    }

    public function show(Request $request){
        //var_dump($request->reminder);die;
        $reminder = EventReminder::findOrFail($request->reminder);

        if(!$reminder){
            return Response::json([
                'error' => [
                    'message' => 'Event reminder doesn\'t exist!'
                ]
            ],422);
        }
        return Response::json(['data' => $reminder],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $attributes = $request->all();     
        $attributes['event_id'] = $request->event; 
        $rules = array(
            'event_id' => 'required | exists:events,id',
            'remind_date' => 'required | date_format:Y-m-d',
            'remind_to' => 'required',            
        );
        $validator = \Validator::make($attributes, $rules);
        if($validator->fails()){
            return Response::json([
                'error' => [
                    'message' => $validator->errors()
                ]
            ],422);
        }else{
            $eventReminder = EventReminder::create($attributes);
            $event = Event::with('eventReminders')->find($attributes['event_id']);
            return Response::json([
                    'message' => 'Event Created Succesfully',
                    'data' => $event
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attributes = $request->all();
        $attributes['event_id'] = $id;
        $attributes['id'] = $request->reminder;

        $rules = array(
            'event_id' => 'required | exists:events,id',
            'remind_date' => 'required | date_format:Y-m-d',
            'remind_to' => 'required',            
        );

        $validator = \Validator::make($attributes, $rules);

        if($validator->fails()){
            var_dump("jjnjtribu9999tes");die;
            return Response::json([
                'error' => [
                    'message' => $validator->errors()
                ]
            ],422);
        }else{
            $eventReminder = EventReminder::find($request->reminder);
            $eventReminder->event_id = $id;
            $eventReminder->remind_date = $request->remind_date;
            $eventReminder->message = $request->message;
            $eventReminder->remind_to = $request->remind_to;
            $eventReminder->save();

            return Response::json([
                    'message' => 'Event Created Succesfully',
                    'data' => $eventReminder
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        EventReminder::destroy($request->reminder);
        return Response::json(['message' => 'Event Reminder Deleted Succesfully']);
    }
}
