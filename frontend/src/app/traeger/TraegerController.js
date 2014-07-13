angular.module('jugendstadtplan.traeger').config(function config( $stateProvider ) {
  
  $stateProvider.state( 'Liste: Traeger', {
    url: '/traeger',
    views: {
      "main": {
        controller: 'TraegerController',
        templateUrl: 'traeger/views/liste.tpl.html'
      }
    },
    data:{ pageTitle: 'Träger' }
  });

});

Jugendstadtplan.Controllers.controller( 'TraegerController', [ '$scope', '$location', 'Traeger', function TraegerController( $scope, $location, Traeger ) {
    $scope.traeger = Traeger.query();

    $scope.viewTraeger = function (traeger) {
      $location.path('/traeger/'+traeger.id);
    };

}]);