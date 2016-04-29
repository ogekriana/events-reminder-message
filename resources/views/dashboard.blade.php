@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">        
        <div class="col-md-8 col-md-offset-2" ng-controller="eventCtrl"> 
            <div ng-init="user_id={{Auth::user()->id }}"></div>
            <div class="panel panel-default" ng-show="events.data.length == 0">
                <div class="panel-heading">You haven't create any Event yet</div>
                <div class="panel-body" style="text-align:center">
                    <p>Click on button bellow to create a new event!</p>
                    <a href="/event/create" type="button" class="btn btn-primary">CREATE NEW EVENT</a>
                </div>                
            </div>                                             
            <div ng-show="events.data.length != 0">
                <a href="" ng-click="openModalCreate()" type="button" class="btn btn-primary btn-block">CREATE NEW EVENT</a> 
                <br>
                <div class="panel panel-default" ng-repeat="event in events.data">
                    <div class="panel-heading">
                        <% event.title %>
                        <span style="float:right">
                            <a ng-if="event.event_reminders.length == 0" ng-click="openCreateReminder(event.id)" href="">Set Reminder</a>
                            <a ng-if="event.event_reminders.length > 0" href="{{url('event/<% event.id %>/reminders')}}">Show Reminder</a>
                        </span>
                    </div>                    
                    <div class="panel-body">
                        <p>Event date: <% event.date %></p>
                        Description: 
                        <p><% event.description %></p>                    
                    </div>           
                    @include('modals.update_event_modal')         
                    @include('modals.create_event_modal')
                    @include('modals.create_reminder_modal')
                    <div class="panel-footer">
                        <div style="text-align:right">
                            <a href="" ng-click="openModalUpdate(event.id)">Update</a>
                             | 
                            <a href="" ng-click="deleteEvent(event.id)">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
