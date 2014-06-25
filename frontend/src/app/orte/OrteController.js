angular.module('jugendstadtplan.orte').config(function config( $stateProvider ) {
  
  $stateProvider.state( 'Liste: Ort', {
    url: '/orte',
    views: {
      "main": {
        controller: 'OrteController',
        templateUrl: 'orte/views/orte.tpl.html'
      }
    },
    data:{ pageTitle: 'Orte' }
  });

});

Jugendstadtplan.Controllers.controller( 'OrteController', [ '$scope', '$location', 'Ort', function OrteController( $scope, $location, Ort ) {
    $scope.orte = Ort.query();

    $scope.viewOrt = function (ort) {
      $location.path('/ort/'+ort.id);
    };

}]);