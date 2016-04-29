<?php

namespace SimpleProject\Http\Controllers;

use Illuminate\Http\Request;
use SimpleProject\Http\Controllers;
use SimpleProject\Http\Requests;
use SimpleProject\Event;
use SimpleProject\User;
use Response;
use DB;

class EventsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
    }
    
    public function index(Request $request){    
        $limit = $request->input('limit',10);
    	$events = Event::orderBy('date','asc')
            ->paginate($limit);
    	return Response::json(['data' => $events], 200);
    }

    public function show(Request $request, $id){
        if(isset($request->with) && ($request->with == 'eventReminders')){
            $event = Event::with($request->with)
                ->findOrFail($id);
        }else{
            $event = Event::findOrFail($id);
        }
    	/*$event = Event::with(
            array('eventReminders'=>function($query){
                $query->select('id','remind_date', 'message', 'remind_to');
                //var_dump($query);die();
            })
            )->find($id);*/		

    	if(!$event){
    		return Response::json([
    			'error' => [
    				'message' => 'Event doesn\'t exist'
    			]
    		], 404);
    	}

    	return Response::json(['data' => $event], 200);
    }

    public function findByUser(Request $request){
        /*$events = Event::leftjoin('event_reminders', 'event_reminders.event_id', '=', 'events.id')
            ->where('events.user_id', $request->user)
            ->groupBy('events.id')
            ->orderBy('events.updated_at', 'desc')
            ->get(['events.*', DB::raw('count(event_reminders.id) as reminders')]);*/

        $events = Event::with('eventReminders')
            ->where('events.user_id', $request->user)
            ->orderBy('events.updated_at', 'desc')
            ->paginate(10);
        return Response::json($events, 200);
    }

    public function store(Request $request){
        $attributes = $request->all();
        $attributes['user_id'] = \Auth::user()->id;
        $rules = array(
            'user_id' => 'required | exists:users,id',
            'date' => 'required | date_format:Y-m-d',
            'title' => 'required',
        );
        $validator = \Validator::make($attributes, $rules);
        if ($validator->fails()) {
            return Response::json([
                'error' =>[
                    $validator->errors()
                ]
            ],422);
        }else{
            $event = Event::create($attributes);

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
        return Response::json(['message' => 'Event Deleted Succesfully']);
    }
}
