'use strict';

/**
 * @ngdoc function
 * @name coq.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of coq
 */
angular.module('coq')
    .controller('RegisterCtrl', function($scope, $http, $location, sessionService) {

       $scope.userId = sessionService.get('uid');

        var config;

		config = {
            params: {
                user: $scope.userId,
 
            }
        };


        $http.post("app/php/setOneUser.php", null, config)
            .success(function (data, status, headers, config) {

            })
            .error(function (data, status, headers, config)
            {
                $scope.errorMessage = "SUBMIT ERROR";
            });       

        $scope.submit = function(user, errorMessage) {
            ;
        }

    });