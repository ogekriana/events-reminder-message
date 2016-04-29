<script type="text/ng-template" id="UpdateRemModal.html">
	<div class="modal-header">
		<div class="modal-title">UPDATE EVENT REMINDER</div>
	</div>
	<div class="modal-body">
		<form>			
	        <div class="form-group">
	        	<label for="reminder-date">Reminder Date</label>				        	
	        	<ng-datepicker ng-model="reminder.remind_date"></ng-datepicker>
	        </div>
	        <div class="form-group">
				<label for="reminder-message">Reminder Message</label>
	        	<textarea id="reminder-message" placeholder="Message" class="form-control" ng-model="reminder.message"></textarea>
	        </div>
	        <div class="form-group">
	        	<label for="reminder-target">Remind To</label>
	        	<input id="reminder-target" placeholder="emailaddress@somedomain.com" class="form-control" type="email" ng-model="reminder.remind_to">				        	
	        </div>	        
		</form>
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-primary" ng-click="editReminder(reminder)">Save</button>
		<button type="submit" class="btn btn-default" ng-click="cancel()">Cancel</button>
	</div>
</script>



