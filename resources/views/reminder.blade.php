@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" ng-controller="eventReminderCtrl">
            <div ng-init="eventId={{ $event }}"></div>
            <div ng-repeat="(key, value) in reminders">
                <p>Date : <% value.date %></p>
                <p>Title : <% value.title %></p>
                <p>Desc : <% value.description %></p>                
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
            </div>
            </div>
        </div>
    </div>
</div>

@endsection
