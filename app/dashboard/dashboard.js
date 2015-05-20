'use strict';

/**
 * @ngdoc function
 * @name coq.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of coq
 */
angular.module('coq')
    .controller('DashboardCtrl', function($scope, $state, loginService) {
        $scope.$state = $state;

        $scope.logout=function(){
            loginService.logout();
        }
    });
