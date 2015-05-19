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


        $scope.numCurrentQuestion = 0;

        var url = "app/json/getDuel.php";
		$http.get(url).success( function(response) {
			$scope.duel = response;
			$scope.currentQuestion = $scope.duel.round.collection.questions[$scope.numCurrentQuestion];
		});

		$scope.inc = function() {
			if($scope.numCurrentQuestion < 4) {
	            $scope.numCurrentQuestion = $scope.numCurrentQuestion+1;
	            $scope.currentQuestion = $scope.duel.round.collection.questions[$scope.numCurrentQuestion];
            }
        }

    });
