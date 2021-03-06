'use strict';

/**
 * @ngdoc function
 * @name coq.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of coq
 */
angular.module('coq')
    .controller('QuizCtrl', function($scope, $state, $http, $stateParams, sessionService) {

        $scope.$state = $state;

        $scope.numCurrentQuestion = 0;
        $scope.score = 0;
        $scope.answers = Array;
        $scope.nbDuelList = 0;

        $scope.timer = 0;
        $scope.timeout;

        $scope.errorMessage;

        $scope.userId = sessionService.get('uid');

     	$scope.me_login;
     	$scope.me_pseudo;

        var config;

        config = {
	            params: {
	                user: $scope.userId,
	            }
	        }; 
        $http.post("app/php/getOneUser.php", null, config)
	            .success(function (data, status, headers, config) {
	           	 	$scope.me_pseudo = data.pseudo;
	           	 	$scope.me_login = data.login;
	            })
	            .error(function (data, status, headers, config)
	            {
	                $scope.errorMessage = "SUBMIT ERROR";
	            });

        $scope.showDuelList = function() {
			config = {
	            params: {
	                user: $scope.userId,
	                duel: 0,
	                score: 0
	            }
	        };
	        $http.post("app/php/getAllDuelsOfUser.php", null, config)
	            .success(function (data, status, headers, config) {
	           	 	$scope.duelList = data.duels;
	           	 	$scope.nbDuelList = data.duels.length;
	           	 	var temp;
	           	 	for(var i = 0; i < $scope.duelList.length; i++) {
           	 			if($scope.me_pseudo == $scope.duelList[i].user2) {
           	 				temp = $scope.duelList[i].score1;
           	 				$scope.duelList[i].score1 = $scope.duelList[i].score2;
           	 				$scope.duelList[i].score2 = temp;
           	 			}
	           	 	}
	            })
	            .error(function (data, status, headers, config)
	            {
	                $scope.errorMessage = "SUBMIT ERROR";
	            });
        }

        $scope.showDuelList();

        config = {
            params: {
                user: $scope.userId,
                duel: 0,
                score: 0
            }
        };
        $http.post("app/php/getAllUsers.php", null, config)
            .success(function (data, status, headers, config) {
           	 	$scope.userList = data.users;
            })
            .error(function (data, status, headers, config)
            {
                $scope.errorMessage = "SUBMIT ERROR";
            });

        $scope.showDuel = function(id) {
        	config = {
	            params: {
	                duel: id,
		           }
	        };
        	$http.post("app/php/duelIsFinishedOrNot.php", null, config)
	            .success(function (data) {
	            	if(data == '1') {
	            		document.getElementById('quizzgame').innerHTML = '<h2>Duel terminé</h2><br/>';
	            	}
	            	else {
	            		$scope.duelId = id;
				        $http.post("app/php/getDuel.php", null, config)
				            .success(function (data, status, headers, config) {
				           	 	$scope.duel = data;
								$scope.currentQuestion = $scope.duel.round.collection.questions[$scope.numCurrentQuestion];
								//document.getElementById('load_spinner').style.display = 'none';
								shuffleAnswers();
								startTimer();
				            })
				            .error(function (data, status, headers, config)
				            {
				                $scope.errorMessage = "SUBMIT ERROR";
				            });

				        $http.post("app/php/getScoreTotalDuel.php", null, config)
				            .success(function (data, status, headers, config) {
				           	 	$scope.scoreTotalDuel = data;
				            })
				            .error(function (data, status, headers, config)
				            {
				                $scope.errorMessage = "SUBMIT ERROR";
				            });
	            	}
	            })
	            .error(function (data, status, headers, config)
	            {
	                $scope.errorMessage = "SUBMIT ERROR";
	            });
		}

		$scope.declareDuel = function(user1, user2) {
			config = {
	            params: {
	                user1: user1,
	                user2: user2,
		           }
	        };
        	$http.post("app/php/createDuel.php", null, config)
	            .success(function () {
	            	$scope.showDuelList();
	            })
	            .error(function (data, status, headers, config)
	            {
	               $scope.errorMessage = "SUBMIT ERROR";
	            });
		}

		function startTimer() {
			document.getElementById('loader').style.display = 'block';
			document.getElementById('border').style.display = 'block';
			var loader = document.getElementById('loader')
			  , border = document.getElementById('border')
			  , pi = Math.PI
			  , t = 30;

			(function draw() {
			  $scope.timer ++;
			  $scope.timer  %= 360;
			  var r = ( $scope.timer  * pi / 180 )
			    , x = Math.sin( r ) * 125
			    , y = Math.cos( r ) * - 125
			    , mid = ( $scope.timer  > 180 ) ? 1 : 0
			    , anim = 'M 0 0 v -125 A 125 125 1 ' 
			           + mid + ' 1 ' 
			           +  x  + ' ' 
			           +  y  + ' z';
			 
			  loader.setAttribute( 'd', anim );
			  border.setAttribute( 'd', anim );

			  if($scope.timer  == 0) {
			  	clearTimeout($scope.timeout);
			  	/*if($scope.numCurrentQuestion < 4) {
				  	$scope.numCurrentQuestion++;
				  	$scope.showDuel($scope.duelId);
			  	}
			  	else {
			  		document.getElementById('quizzgame').innerHTML = '<h2>Série terminée</h2><br/>';
	            	$scope.numCurrentQuestion = 0;

	            	endSerie($scope.userId, $scope.duelId, $scope.score);
			  	}*/

			  	$http.get(".").success(function (data) {
	           	 	$scope.valider(0);
	            })

			  }
			  else {
			  	$scope.timeout = setTimeout(draw, t);
			 }
			})();
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
			clearTimeout($scope.timeout);
			$scope.timer = 0;
			if($scope.numCurrentQuestion <= 5) {
				if(isOk) {
					$scope.score = $scope.score+1;
				}
	            $scope.numCurrentQuestion = $scope.numCurrentQuestion+1;
	            $scope.currentQuestion = $scope.duel.round.collection.questions[$scope.numCurrentQuestion];

	            if($scope.numCurrentQuestion == 5) {
	            	/*if(duelFinished($scope.duelId) == '1') {
	            		document.getElementById('quizzgame').innerHTML = '<h2>Duel terminée</h2><br/>';
	            	}
	            	else {*/
	            		document.getElementById('quizzgame').innerHTML = '<h2>Série terminée</h2><br/>';
	            	//}
	            	$scope.numCurrentQuestion = 0;
	            	document.getElementById('loader').style.display = 'none';
					document.getElementById('border').style.display = 'none';

	            	endSerie($scope.userId, $scope.duelId, $scope.score);
	            }
	            else {
	            	shuffleAnswers();
	            	startTimer();
	            }
            }         
        }

        function endSerie(userId, duelId, score) {
        	config = {
	            params: {
	                user: userId,
	                duel: duelId,
	                score: score
		           }
	        };
	        console.log(userId+" "+duelId+" "+score);
        	$http.post("app/php/submitRound.php", null, config)
	            .success(function () {
	            	console.log('success');
	            })
	            .error(function (data, status, headers, config)
	            {
	               $scope.errorMessage = "SUBMIT ERROR";
	            });
        }

    });
