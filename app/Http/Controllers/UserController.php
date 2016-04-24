<?php

namespace SimpleProject\Http\Controllers;

use Illuminate\Http\Request;

use SimpleProject\Http\Requests;
use SimpleProject\User;
use Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //var_dump(User::all());
        $users = User::with('events')->get();
        return Response::json([ 'data' => $users],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('events')->find($id);
        if(!$user){
            return Response::json([
                'error' => [
                    'message' => 'User doesn\'t exist'
                ]
            ],404);
        }
        return Response::json([ 'data' => $user],200);
    }

}
