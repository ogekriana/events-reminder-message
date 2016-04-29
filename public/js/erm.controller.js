var ermAppController = angular.module('ermAppController', ['ermAppServices']);
ermAppController.controller('eventCtrl', ['$scope','$window','eventService', '$uibModal', '$log', function($scope, $window, $eventService, $uibModal, $log){

	$scope.$watch('user_id', function () {
		$eventService.getEventByUser($scope.user_id).then(function(response){
			$scope.events = response.data;
		});
	}); 

	$scope.deleteEvent = function(eventId){
		$eventService.eventDelete(eventId)
			.success(function(data){
				alert(data.message);
				$window.location.reload();
			})
			.error(function(data){
				alert("Failed to delete event!");
			});		
	} 

	$scope.animationsEnabled = true;
	$scope.openModalUpdate = function(param){
		$eventService.setEventId(param);		
		
    	var modalInstance = $uibModal.open({
      		animation: $scope.animationsEnabled,
      		templateUrl: 'UpdateEvModal.html',
      		controller: 'UpdateEventModal',
      		resolve: {
        		items: function () {
          			return $scope.items;
        		}
      		}
    	});
 	};

 	$scope.openModalCreate = function(){
 		var modalInstance = $uibModal.open({
 			animation: $scope.animationsEnabled,
 			templateUrl: 'CreateEvModal.html',
 			controller: 'createEventCtrl' 			
 		});
 	};	

  	$scope.toggleAnimation = function () {
    	$scope.animationsEnabled = !$scope.animationsEnabled;
  	};

}]);

ermAppController.controller('createEventCtrl', ['$scope','$window','eventService','$uibModalInstance', function($scope,$window, $eventService, $uibModalInstance){
	$scope.createEvent = function(ev){	
		$scope.master = angular.copy(ev);
		$eventService.createEvent($scope.master)
			.success(function(data) {
				$scope.message = data.message;	
				$uibModalInstance.close();
				$window.location.reload();		
			})
			.error(function(data) {
				$scope.reasons = data.reasons;
			});
	}
}]);	

ermAppController.controller('UpdateEventModal', ['$scope','eventService','$uibModalInstance','$window', function($scope, $eventService,$uibModalInstance, $window){

	$eventService.getEventById().then(function(response){
		$scope.items = response.data.data;
	});
	$scope.updateEvent = function(data){
		$eventService.updateEvent(data)
			.success(function(data){
				$uibModalInstance.close();
				$window.location.reload();
			})
			.error(function(data){

			});
	}

	$scope.cancel = function(){
		$uibModalInstance.dismiss('cancel');
	}

}]);

ermAppController.controller('eventReminderCtrl', function($scope, $http){
	$scope.$watch('eventId', function () {
    	var endpoint = '/v1/events/'+$scope.eventId+'';
		$http.get(endpoint).success(function ($reminders) {
	        $scope.reminders = $reminders;        
	    }); 
	});
});