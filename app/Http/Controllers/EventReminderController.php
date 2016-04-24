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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $attributes['event_id'] = $request->events; 
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $attributes['id'] = $request->reminders;
        //var_dump("ttributes");die;
        $rules = array(
            'event_id' => 'required | exists:events,id',
            'remind_date' => 'required | date_format:Y-m-d',
            'remind_to' => 'required',            
        );
        //var_dump("attrib88utes");die;
        $validator = \Validator::make($attributes, $rules);
        //var_dump("jjnjtributes");die;
        if($validator->fails()){
            var_dump("jjnjtribu9999tes");die;
            return Response::json([
                'error' => [
                    'message' => $validator->errors()
                ]
            ],422);
        }else{
            //var_dump("jjnjt909090ributes");die;
            $eventReminder = EventReminder::find($request->reminders);
            //var_dump($eventReminder);die;
            $eventReminder->event_id = $id;
            $eventReminder->remind_date = $request->remind_date;
            $eventReminder->message = $request->message;
            $eventReminder->remind_to = $request->remind_to;
            $eventReminder->save();
            //var_dump($eventReminder);die;
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
    public function destroy($id)
    {
        //
    }
}
