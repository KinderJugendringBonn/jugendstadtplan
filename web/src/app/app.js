var Jugendstadtplan = Jugendstadtplan || {};
Jugendstadtplan.Controllers = angular.module('jugendstadtplan.controllers', []);

angular.module( 'jugendstadtplan', [
  'ngResource',
  'ngSanitize',
  'ui.router',
  'leaflet-directive',
  'textAngular',
  'angularFileUpload',
  'jugendstadtplan.api',
  'jugendstadtplan.startseite',
  'jugendstadtplan.pins',
  'jugendstadtplan.traeger',
  'jugendstadtplan.controllers'
])

.config( function myAppConfig ( $stateProvider, $urlRouterProvider ) {
  $urlRouterProvider.otherwise( '/startseite' );
})

.run( function run () {
})

.controller( 'AppCtrl', [ '$scope', '$location', function AppCtrl( $scope, $location ){
  $scope.$on('$stateChangeSuccess', function(event, toState, toParams, fromState, fromParams){
    if ( angular.isDefined( toState.data.pageTitle ) ) {
      $scope.pageTitle = toState.data.pageTitle + ' | Jugendstadtplan' ;
    }
  });
}])

;