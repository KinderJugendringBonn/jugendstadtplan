angular.module('jugendstadtplan.angebote').config(function config( $stateProvider ) {
  
  $stateProvider.state( 'Liste: Angebot', {
    url: '/angebote',
    views: {
      "main": {
        controller: 'AngeboteController',
        templateUrl: 'angebote/views/liste.tpl.html'
      }
    },
    data:{ pageTitle: 'Angebote' }
  });

});

Jugendstadtplan.Controllers.controller( 'AngeboteController', [ '$scope', '$location', 'AngeboteApi', function AngeboteController( $scope, $location, $angeboteApi ) {
    $scope.angebote = $angeboteApi.query();

    $scope.viewAngebot = function (angebot) {
      $location.path('/angebot/'+angebot.id);
    };

}]);