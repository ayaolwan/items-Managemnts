var app =  angular.module('main-App',['ngRoute','angularUtils.directives.dirPagination','angularModalService','datatables','angucomplete']);

app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', {
                templateUrl: 'templates/items.html',
                controller: 'ItemController'
            });
           /* // when('/items', {
            //     templateUrl: 'templates/items.html',
            //     controller: 'ItemController'
            // });*/
}]);