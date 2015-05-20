'use strict';
app.factory('loginService',function($http, $location, sessionService){
    return{
        login:function(data, scope){
            var $promise=$http.post('app/php/connect.php', data); //send data to user.php
            $promise.then(function(msg){
                var uid=msg.data;
                //alert(uid);
                if ( uid ) {
                    //scope.msgtxt='Correct information';
                    sessionService.set('uid',uid);
                    $location.path('/dashboard');
                }
                else  {
                    scope.msgtxt='incorrect information';
                    $location.path('/login');
                }
            });
        },
        logout:function(){
            sessionService.destroy('uid');
            $location.path('/login');
        },
        islogged:function(){
            var $checkSessionServer=$http.post('app/php/checkSession.php');
            return $checkSessionServer;
            /*
             if(sessionService.get('user')) return true;
             else return false;
             */
        }
    }

});