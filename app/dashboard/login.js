'use strict';

/**
 * @ngdoc function
 * @name coq.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of coq
 * , ['ngCookies']
 */
angular.module('coq')
    .controller('LoginCtrl', function($scope, $http, $location, loginService) {

        $scope.submit = function(user, errorMessage) {
            loginService.login(user, $scope);
        }

    });