var ermApp = angular.module('ermApp', ['ngRoute', 'ermAppController', 'jkuri.datepicker', 'ui.bootstrap'],  function($interpolateProvider){
	$interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');	
});

ermApp.directive('postsPagination', function(){  
   return{
      restrict: 'E',
      template: '<ul class="pagination">'+
        '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="init(user_id,1)">&laquo;</a></li>'+
        '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="init(user_id,currentPage-1)">&lsaquo; Prev</a></li>'+
        '<li ng-repeat="i in pages" ng-class="{active : currentPage == i}">'+
            '<a href="javascript:void(0)" ng-click="init(user_id,i)"><% i %></a>'+
        '</li>'+
        '<li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="init(user_id,currentPage+1)">Next &rsaquo;</a></li>'+
        '<li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="init(user_id,totalPages)">&raquo;</a></li>'+
      '</ul>'
   };
});
//http://blog.kettle.io/dynamic-pagination-angularjs-laravel/
//https://www.codetutorial.io/laravel-5-pagination-angular-js-load/