var ermAppController = angular.module('ermAppController', ['ermAppServices']);
ermAppController.controller('eventCtrl', ['$scope','eventService', function($scope, $eventService){
	console.log("hey hey uuu");
	$scope.$watch('user_id', function () {
		console.log("hey hey");
		$eventService.getEventByUser($scope.user_id).then(function(response){
			$scope.events = response.data;
		});
	});   	

}]);


ermAppController.controller('eventReminderCtrl', function($scope, $http){
	$scope.$watch('eventId', function () {
    	var endpoint = '/v1/events/'+$scope.eventId+'';
		$http.get(endpoint).success(function ($reminders) {
	        $scope.reminders = $reminders;        
	    }); 
	});
});

ermAppController.controller('createEventCtrl', ['$scope','$window','eventService', function($scope,$window, $eventService){
	$scope.createEvent = function(ev){	
		$scope.master = angular.copy(ev);
		$eventService.createEvent($scope.master)
			.success(function(data) {
				$scope.message = data.message;	
				alert($scope.message);
				$window.location.href = '/dashboard';		
			})
			.error(function(data) {
				$scope.reasons = data.reasons;
			});
	}
}]);	