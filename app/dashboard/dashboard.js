'use strict';

/**
 * @ngdoc function
 * @name coq.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of coq
 */
angular.module('coq')
    .controller('DashboardCtrl', function($scope, $state, loginService, sessionService, $http) {
        $scope.$state = $state;


        $scope.login;
        $scope.password;
        $scope.rights;
        $scope.pseudo;

        $scope.userId = sessionService.get('uid');

        var config;

		config = {
            params: {
                user: $scope.userId,
            }
        };

        $http.post("app/php/getOneUser.php", null, config)
            .success(function (data, status, headers, config) {
           	 	$scope.login = data.login;
           	 	$scope.password = data.password;
           	 	$scope.rights = data.rights;
           	 	$scope.pseudo = data.pseudo;
            })
            .error(function (data, status, headers, config)
            {
                $scope.errorMessage = "SUBMIT ERROR";
            });       

        $scope.logout=function(){
            loginService.logout();
        }
    });
