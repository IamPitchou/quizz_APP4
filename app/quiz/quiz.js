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

        $scope.numCurrentQuestion = 0;
        $scope.score = 0;
        $scope.answers = Array;
        $scope.nbDuelList = 0;

        var config;

		config = {
            params: {
                user: '1'
            }
        };
        $http.post("app/php/getAllDuelsOfUser.php", null, config)
            .success(function (data, status, headers, config) {
           	 	$scope.duelList = data.duels;
           	 	$scope.nbDuelList = data.duels.length;
            })
            .error(function (data, status, headers, config)
            {
                $scope[errorMessage] = "SUBMIT ERROR";
            });

        $scope.showDuel = function(id) {
			config = {
            params: {
                duel: id
	            }
	        };
	        $scope.duelId = id;
	        $http.post("app/php/getDuel.php", null, config)
	            .success(function (data, status, headers, config) {
	           	 	$scope.duel = data;
					$scope.currentQuestion = $scope.duel.round.collection.questions[$scope.numCurrentQuestion];
					//document.getElementById('load_spinner').style.display = 'none';
					shuffleAnswers();
	            })
	            .error(function (data, status, headers, config)
	            {
	                $scope[errorMessage] = "SUBMIT ERROR";
	            });

	        $http.post("app/php/getScoreTotalDuel.php", null, config)
	            .success(function (data, status, headers, config) {
	           	 	$scope.scoreTotalDuel = data;
	            })
	            .error(function (data, status, headers, config)
	            {
	                $scope[errorMessage] = "SUBMIT ERROR";
	            });
		}

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
			if($scope.numCurrentQuestion <= 5) {
				if(isOk) {
					$scope.score = $scope.score+1;
				}
	            $scope.numCurrentQuestion = $scope.numCurrentQuestion+1;
	            $scope.currentQuestion = $scope.duel.round.collection.questions[$scope.numCurrentQuestion];

	            if($scope.numCurrentQuestion == 5) {
	            	document.getElementById('quizzgame').innerHTML = '<h2>Série terminée</h2><br/>';
	            	$scope.numCurrentQuestion = 0;

	            	endSerie('1', $scope.duelId, $scope.score);
	            }
	            else {
	            	shuffleAnswers();
	            }
            }         
        }

        function endSerie(userId, duelId, score) {
        	
        }

    });
