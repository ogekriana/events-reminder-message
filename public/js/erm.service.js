var ermAppServices = angular.module('ermAppServices', []);

ermAppServices.service('eventService', ['$http', function($http){
	

	this.getEventByUser = function(userId){
		console.log("service get event");
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

}]);


