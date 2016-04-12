angular.module('jugendstadtplan.traeger').config(['$stateProvider', function config( $stateProvider ) {

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

}]);

Jugendstadtplan.Controllers.controller( 'TraegerLoginController', [ '$scope', '$state', '$window', 'LoginService', 'jwtHelper', 'Traeger', function TraegerLoginController( $scope, $state, $window, LoginService, jwtHelper, Traeger) {

    $scope.traeger = new Traeger();

    $scope.login = function() {
        $scope.traeger.$login()
            .then(function(response) {
                LoginService.login(response.token);

                $state.go('Startseite');
            }, function(error) {
                $scope.error = {
                    msg: 'Authentifizierung fehlgeschlagen!'
                }
            });
    };
}]);
