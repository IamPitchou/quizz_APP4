'use strict';

/**
 * @ngdoc function
 * @name coq.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of coq
 */
angular.module('coq')
    .controller('QuizCtrl', function($scope, $state, $http, $sce) {

        $scope.$state = $state;


        $scope.numCurrentQuestion = 0;
        $scope.score = 0;
        $scope.answers = Array;

        var url = "app/json/getDuel.php";
		$http.get(url).success( function(response) {
			$scope.duel = response;
			$scope.currentQuestion = $scope.duel.round.collection.questions[$scope.numCurrentQuestion];

			$scope.answers[0] = $scope.currentQuestion.answerOK;
			$scope.answers[1] = $scope.currentQuestion.answer1;
			$scope.answers[2] = $scope.currentQuestion.answer2;
			$scope.answers[3] = $scope.currentQuestion.answer3;
			// Shuffle
			for(var j, x, i = 4; i; j = Math.floor(Math.random() * i), x = $scope.answers[--i], $scope.answers[i] = $scope.answers[j], $scope.answers[j] = x);

		});

		var url = "app/json/getScoreTotalDuel.php";
		$http.get(url).success( function(response) {
			$scope.scoreTotalDuel = response;
		});

		var url = "app/php/getShuffledAnswers.php?id="+$scope.numCurrentQuestion;
		$http.get(url).success( function(response) {
			$scope.shuffledAnswersTab = $sce.trustAsHtml(response);
		});

		$scope.valider = function(isOk) {
			if($scope.numCurrentQuestion < 4) {
				if(isOk) {
					$scope.score = $scope.score+1;
				}
	            $scope.numCurrentQuestion = $scope.numCurrentQuestion+1;
	            $scope.currentQuestion = $scope.duel.round.collection.questions[$scope.numCurrentQuestion];
            }
        }

    });
