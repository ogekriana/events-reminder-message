var ermApp = angular.module('ermApp', ['ngRoute', 'ermAppController'],  function($interpolateProvider){
	$interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');	
});


ermApp.config(['$routeProvider', '$locationProvider',
  function($routeProvider, $locationProvider) {
  	$locationProvider
  		.html5Mode({
  			enabled: true,
  			requireBase: false
		})
		.hashPrefix('*');
  	//console.log("config");
}]);


