<script type="text/ng-template" id="CreateEvModal.html">
	<div class="modal-header">
		<div class="modal-title">UPDATE EVENT</div>
	</div>
	<div class="modal-body">
		<form>
			<div class="form-group">
				<label for="event-title">Event Title</label>
	        	<input id="event-title" placeholder="Event Title" class="form-control" type="text" ng-model="ev.title">
	        </div>
	        <div class="form-group">
	        	<label for="event-date">Event Date</label>				        	
	        	<ng-datepicker ng-model="ev.date"></ng-datepicker>
	        </div>
	        <div class="form-group">
	        	<label for="event-description">Event description</label>
	        	<textarea id="event-description" placeholder="Event Description" class="form-control" type="text" ng-model="ev.description"></textarea>				        	
	        </div>	        
		</form>
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-primary" ng-click="createEvent(ev)">Save</button>
		<button type="submit" class="btn btn-default" ng-click="cancel()">Cancel</button>
	</div>
</script>



