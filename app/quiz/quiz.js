'use strict';

/**
 * @ngdoc function
 * @name coq.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of coq
 */
angular.module('coq')
    .controller('QuizCtrl', function($scope, $state, $http, $stateParams) {

        $scope.$state = $state;

        /*$scope.getAllDuelsOfUser = function() {

        };*/

        $scope.numCurrentQuestion = 0;
        $scope.score = 0;
        $scope.answers = Array;
        $scope.nbDuelList = 0;
        $scope.idDuel = $stateParams.idDuelClicked;

        var urlAllUsers = "app/json/getAllDuelsOfUser.php";
        $http.get(urlAllUsers).success( function(response) {
            $scope.duelList = response.duels;
            $scope.nbDuelList = response.duels.length;
        }).error( function() {
            $scope.duelList = 0;
        });

        $scope.showDuel = function(id) {
	        var url = "app/php/getDuel.php?duel="+id;
			$http.get(url).success( function(response) {
				$scope.duel = response;
				$scope.currentQuestion = $scope.duel.round.collection.questions[$scope.numCurrentQuestion];
				//document.getElementById('load_spinner').style.display = 'none';
				shuffleAnswers();
			});
		}

		var url = "app/json/getScoreTotalDuel.php";
		$http.get(url).success( function(response) {
			$scope.scoreTotalDuel = response;
		});

		function shuffleAnswers() {
			$scope.answers[0] = Array(1, $scope.currentQuestion.answerOK);
			$scope.answers[1] = Array(0, $scope.currentQuestion.answer1);
			$scope.answers[2] = Array(0, $scope.currentQuestion.answer2);
			$scope.answers[3] = Array(0, $scope.currentQuestion.answer3);
			for(var j, x, i = 4; i; j = Math.floor(Math.random() * i), x = $scope.answers[--i], $scope.answers[i] = $scope.answers[j], $scope.answers[j] = x);
			$scope.answersShuffled = [
		        {isOk : $scope.answers[0][0], name : $scope.answers[0][1]},
		        {isOk : $scope.answers[1][0], name : $scope.answers[1][1]},
		        {isOk : $scope.answers[2][0], name : $scope.answers[2][1]},
		        {isOk : $scope.answers[3][0], name : $scope.answers[3][1]},
		    ];
		}

		$scope.valider = function(isOk) {
			if(isOk) {
				$scope.score = $scope.score+1;
			}
			if($scope.numCurrentQuestion < 4) {
	            $scope.numCurrentQuestion = $scope.numCurrentQuestion+1;
	            $scope.currentQuestion = $scope.duel.round.collection.questions[$scope.numCurrentQuestion];

	            shuffleAnswers(); 
            }
            else if($scope.numCurrentQuestion >= 4) {
            	$scope.numCurrentQuestion = 0;
            }
        }

    });
