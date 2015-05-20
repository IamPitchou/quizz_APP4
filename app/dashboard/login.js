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
    .controller('LoginCtrl', function($scope, $http, $location) {

        $scope.submit = function(user, errorMessage) {
            var config = {
                params: {
                    user: user
                }
            };

            $http.post("app/php/connect.php", null, config)
                .success(function (data, status, headers, config)
                {
                    /*/ Si on trouve le cookie
                    var coqCookie = $cookies.get('coq');
                    if (coqCookie != null) {
                        // on a le cookie, on est connecté
                        $location.path('/dashboard'); //
                    }*/

                    //
                    $scope[errorMessage] = data;
                    // sinon ...
                })
                .error(function (data, status, headers, config)
                {
                    $scope[errorMessage] = "SUBMIT ERROR"; // Erreur de soumission du formulaire
                });

            return false;
        }

    });