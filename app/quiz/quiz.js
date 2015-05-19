'use strict';

/**
 * @ngdoc function
 * @name coq.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of coq
 */
angular.module('coq')
    .controller('QuizCtrl', function($scope, $state, $http) {

        $scope.$state = $state;


        var url = "app/json/getDuel.php";
		$http.get(url).success( function(response) {
			$scope.duel = response;
		});

    });
