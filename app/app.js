'use strict';

/**
 * @ngdoc overview
 * @name yapp
 * @description
 * # yapp
 *
 * Main module of the application.
 */
var app = angular
	.module('coq', [
		'ui.router',
		'ngAnimate'
	]);

app.config(function($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.when('/dashboard', '/dashboard/overview');
    $urlRouterProvider.when('/quiz', '/quiz/overview');
    $urlRouterProvider.otherwise('/login');

    $stateProvider
        .state('base', {
            abstract: true,
            url: '',
            templateUrl: 'app/views/base.html'
        })
        .state('base-menu', {
            abstract: true,
            url: '',
            templateUrl: 'app/views/base-menu.html'
        })
        .state('login', {
            url: '/login',
            parent: 'base',
            templateUrl: 'app/views/login.html',
            controller: 'LoginCtrl'
        })
        .state('dashboard', {
            url: '/dashboard',
            parent: 'base-menu',
            templateUrl: 'app/views/dashboard.html',
            controller: 'DashboardCtrl'
        })
        .state('d_overview', {
            url: '/overview',
            parent: 'dashboard',
            templateUrl: 'app/views/dashboard/overview.html'
        })
        .state('reports', {
            url: '/reports',
            parent: 'dashboard',
            templateUrl: 'app/views/dashboard/reports.html'
        })
        .state('d_account', {
            url: '/account',
            parent: 'dashboard',
            templateUrl: 'app/views/dashboard/account.html'
        })
        .state('quiz', {
            url: '/quiz',
            parent: 'base-menu',
            templateUrl: 'app/views/quiz.html',
            controller: 'QuizCtrl'
        })
        .state('q_overview', {
            url: '/overview',
            parent: 'quiz',
            templateUrl: 'app/views/quiz/overview.html'
        })
        .state('game', {
            url: '/game',
            parent: 'quiz',
            templateUrl: 'app/views/quiz/game.html'
        })
    ;
});

app.run( function($rootScope, $location, loginService) {

    $rootScope.$on('$routeChangeStart', function(e, toState, toParams, fromState, fromParams) {
        if( toState.name != 'login') {

            var connected = loginService.islogged();
            connected.then( function(msg) {
                if(!msg.data) $location.path('/login');
            });
        }
    });
});