angular.module( 'ngBoilerplate.orte', [
  'ui.router',
  'placeholders',
  'ui.bootstrap'
])

.config(function config( $stateProvider ) {
  
  $stateProvider.state( 'orte', {
    url: '/orte',
    views: {
      "main": {
        controller: 'OrteController',
        templateUrl: 'orte/orte.tpl.html'
      }
    },
    data:{ pageTitle: 'Orte' }
  });

})

.controller( 'OrteController', [ '$scope', 'OrteApi', function OrteController( $scope, $orteApi ) {
    $scope.orte = $orteApi.query();
}])

;
