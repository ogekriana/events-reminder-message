@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" ng-controller="reminderCtrl">
            <div ng-init="eventId={{ $event }}"></div>
            <div ng-repeat="(key, value) in reminders">
                <p>Date : <% value.date %></p>
                <p>Title : <% value.title %></p>
                <p>Desc : <% value.description %></p>  

                <a href="" ng-click="openCreateReminder(value.id)" type="button" class="btn btn-primary btn-block">CREATE NEW REMINDER</a> 
                <br>              
            <div class="panel panel-default" ng-repeat="reminder in value.event_reminders">
                <div class="panel-heading">
                    Remind to : <% reminder.remind_to %>
                    <span style="float:right">
                        On: <% reminder.remind_date %>
                    </span>
                </div>
                <div class="panel-body">
                    <p><% reminder.message %></p>                                    
                </div>
                <div class="panel-footer" style="text-align:right">
                    <a href="" ng-click="updateReminderModal(reminder.id)">Update</a>
                     | 
                     <a href="" ng-click="delReminder(reminder.id,value.id)">Delete</a>
                </div>
            </div>
            </div>
            @include('modals.create_reminder_modal')
            @include('modals.update_reminder_modal')
        </div>
    </div>
</div>

@endsection
