var Jugendstadtplan = Jugendstadtplan || {};
Jugendstadtplan.Controllers = angular.module('jugendstadtplan.controllers', []);

angular.module( 'ngBoilerplate', [
  'ngResource',
  'ngSanitize',
  'ui.router',
  'templates-app',
  'templates-common',
  'ngBoilerplate.home',
  'jugendstadtplan.api',
  'jugendstadtplan.orte',
  'jugendstadtplan.traeger',
  'jugendstadtplan.angebote',
  'jugendstadtplan.controllers'
])

.config( function myAppConfig ( $stateProvider, $urlRouterProvider ) {
  $urlRouterProvider.otherwise( '/home' );
})

.run( function run () {
})

.controller( 'AppCtrl', function AppCtrl ( $scope, $location ) {
  $scope.$on('$stateChangeSuccess', function(event, toState, toParams, fromState, fromParams){
    if ( angular.isDefined( toState.data.pageTitle ) ) {
      $scope.pageTitle = toState.data.pageTitle + ' | ngBoilerplate' ;
    }
  });
})

;