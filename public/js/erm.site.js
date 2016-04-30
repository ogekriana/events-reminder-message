var ermApp = angular.module('ermApp', ['ngRoute', 'ermAppController', 'jkuri.datepicker', 'ui.bootstrap'],  function($interpolateProvider){
	$interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');	
});