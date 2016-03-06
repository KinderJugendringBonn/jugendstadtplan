angular.module('jugendstadtplan.traeger').config(function config( $stateProvider ) {

    $stateProvider.state( 'Login: Traeger', {
        url: '/traeger/login',
        views: {
            "main": {
                controller: 'TraegerLoginController',
                templateUrl: 'app/traeger/views/login.tpl.html'
            }
        },
        data:{ pageTitle: 'Einloggen' }
    });

});

Jugendstadtplan.Controllers.controller( 'TraegerLoginController', [ '$scope', '$state', '$window', 'LoginService', 'Traeger', function TraegerLoginController( $scope, $state, $window, LoginService, Traeger) {

    $scope.traeger = new Traeger();

    $scope.login = function() {
        $scope.traeger.$login()
            .then(function(response) {
                $window.localStorage.token = response.token;
                LoginService.setLoggedIn(true);

                $state.go('Startseite');
            }, function(error) {
                $scope.error = {
                    msg: 'Authentifizierung fehlgeschlagen!'
                }
            });
    };
}]);
