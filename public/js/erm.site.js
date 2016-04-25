angular.module('erm', [],  function($interpolateProvider){
	$interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');	
})
.controller('eventCtrl', function($scope, $http){
	$scope.$watch('user_id', function () {
    	var endpoint = '/v1/users/'+$scope.user_id+'/events';
		$http.get(endpoint).success(function ($events) {
	        $scope.events = $events;        
	    }); 
	});
	
	   
})
.controller('eventReminderCtrl', function($scope, $http){
	$scope.$watch('eventId', function () {
    	var endpoint = '/v1/events/'+$scope.eventId+'';
		$http.get(endpoint).success(function ($reminders) {
	        $scope.reminders = $reminders;        
	    }); 
	});
});
