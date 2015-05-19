'use strict';

/**
 * @ngdoc function
 * @name coq.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of coq
 */
angular.module('coq')
  .controller('LoginCtrl', function($scope, $location) {

    $scope.submit = function() {

      $location.path('/dashboard');

      return false;
    }

  });
