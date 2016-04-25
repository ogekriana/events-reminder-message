@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" ng-controller="eventCtrl">
            <div ng-init="user_id={{Auth::user()->id }}"></div>
            <div ng-repeat="(key, value) in events">
            <div class="panel panel-default" ng-repeat="event in value">
                <div class="panel-heading">
                    <% event.title %>
                    <span style="float:right">
                        <a href="{{url('event/<% event.id %>/reminders')}}">Reminder</a>
                    </span>
                </div>

                <div class="panel-body">
                    <p>Dvent date: <% event.date %></p>
                    Description: 
                    <p><% event.description %></p>                    
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection
