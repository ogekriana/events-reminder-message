@extends('layouts.app')

@section('content')
<div class="container" id="create_event.html">
    <div class="row">        
        <div class="col-md-8 col-md-offset-2" ng-controller="createEventCtrl"> 
        	<div class="panel panel-default">
        		<div class="panel-heading">Create Event</div>
                <div class="panel-body">
	           		<form>
						<div class="form-group">
							<label for="event-title">Event Title</label>
				        	<input id="event-title" placeholder="Event Title" class="form-control" type="text" ng-model="ev.title">
				        </div>
				        <div class="form-group">
				        	<label for="event-date">Event Date</label>
				        	<input id="event-date" placeholder="Event Date" class="form-control" type="text" ng-model="ev.date">
				        </div>
				        <div class="form-group">
				        	<label for="event-description">Event description</label>
				        	<input id="event-description" placeholder="Event Description" class="form-control" type="text" ng-model="ev.description">
				        </div>
				        <div class="form-group">
				        	<button type="submit" ng-click="createEvent(ev)" class="btn btn-primary" >Save Event</button>
				        </div>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection
