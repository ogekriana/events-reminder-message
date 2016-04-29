var ermAppServices = angular.module('ermAppServices', []);

ermAppServices.service('eventService', ['$http', function($http){
	this.eventId;

	this.setEventId = function(eventId){
		this.eventId = eventId;
	};

	this.getEventById = function(){		
		console.log("this is eventID"+this.eventId);
		var endpoint = '/v1/events/'+this.eventId;
		return $http({
			method: 'GET',
			url: endpoint
		})
		.success(function(data){
			console.log(data);
			return data;
		})
		.error(function(data){
			return data;
		});
	}

	this.getEventByUser = function(userId){
		console.log("service get event 888");
		var endpoint = '/v1/users/'+userId+'/events';
	    return $http({
				method: 'GET',
				url: endpoint
			})
			.success(function(data) {
				return data;
			})
			.error(function(data) {
				return data;
			});
	};

	this.createEvent = function(param){
		console.log("create event");
		var endpoint = '/v1/events';
		return $http({
			method : 'POST',
			url : endpoint,
			data : param,
			headers: {
					'Content-Type': 'application/json'
				}
			})
			.success(function(data){
				return data;
			})
			.error(function(data){
				return data;
			});
	};

	this.updateEvent =function(param){
		console.log(param.id);
		var id = param.id;
		var endpoint = '/v1/events/'+id;
		return $http({
			method: 'PUT',
			url: endpoint,
			data: param,
			headers: {'Content-Type': 'application/json'}
		})
		.success(function(data){
			return data;
		})
		.error(function(data){
			return data;
		});		
	};

	this.eventDelete = function(eventId){
		console.log("delete event");
		var endpoint = '/v1/events/'+eventId;
		return $http({
			method : 'DELETE',
			url : endpoint
			})
			.success(function(data){
				return data;
			})
			.error(function(data){
				return data;
			});
	};

}]);

ermAppServices.service('reminderService', ['$http', 'eventService', function($http, $eventService){
	this.createReminder = function(param){
		//console.log($eventService.eventId);
		var endpoint = '/v1/events/'+$eventService.eventId+'/reminders';
		return $http({
			method: 'POST',
			url: endpoint,
			data: param,
			header: {'Content-Type': 'application/json'}
		})
		.success(function(data){
			return data;
		})
		.error(function(data){
			return data;
		});
	};
}]);


