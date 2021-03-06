var Jugendstadtplan = Jugendstadtplan || {};
Jugendstadtplan.Controllers = angular.module('jugendstadtplan.controllers', []);

angular.module( 'jugendstadtplan', [
  'ngResource',
  'ngSanitize',
  'ui.router',
  'leaflet-directive',
  'textAngular',
  'ngFileUpload',
  'angular-jwt',
  'jugendstadtplan.templates',
  'jugendstadtplan.login',
  'jugendstadtplan.api',
  'jugendstadtplan.startseite',
  'jugendstadtplan.pins',
  'jugendstadtplan.traeger',
  'jugendstadtplan.controllers'
])

.config([ '$stateProvider', '$urlRouterProvider', function myAppConfig( $stateProvider, $urlRouterProvider ) {
  $urlRouterProvider.otherwise( '/startseite' );
}])

.run( function run () {
})

.controller( 'AppCtrl', [ '$scope', 'LoginService', '$state', function AppCtrl($scope, LoginService, $state){

  $scope.$on('$stateChangeSuccess', function(event, toState, toParams, fromState, fromParams){
    if ( angular.isDefined( toState.data.pageTitle ) ) {
      $scope.pageTitle = toState.data.pageTitle + ' | Jugendstadtplan' ;
    }
  });

  // Reinitalize LoginService
  LoginService.init();

  $scope.isLoggedIn = function() {
    return LoginService.isLoggedIn();
  };
  
  $scope.getJugendstadtplanUser = function() {
    return LoginService.getJugendstadtplanUser();
  };

  $scope.logout = function() {
    LoginService.logout();

    $state.go('Startseite');
  };

}])

;