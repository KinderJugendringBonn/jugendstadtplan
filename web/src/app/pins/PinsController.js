angular.module('jugendstadtplan.pins').config(function config( $stateProvider ) {
  
  $stateProvider.state( 'Liste: Pin', {
    url: '/pins',
    views: {
      "main": {
        controller: 'PinsController',
        templateUrl: 'src/app/pins/views/list.tpl.html'
      }
    },
    data:{ pageTitle: 'Pins' }
  });

});

Jugendstadtplan.Controllers.controller( 'PinsController', [ '$scope', '$location', 'Pin', function PinsController( $scope, $location, Pin ) {
    $scope.pins = Pin.query();

    $scope.viewPin = function (pin) {
      $location.path('/pin/'+pin.id);
    };

}]);