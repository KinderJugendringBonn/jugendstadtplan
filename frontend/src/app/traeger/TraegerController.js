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

Jugendstadtplan.Controllers.controller( 'TraegerController', [ '$scope', '$location', 'TraegerApi', function TraegerController( $scope, $location, $traegerApi ) {
    $scope.traeger = $traegerApi.query();

    $scope.viewTraeger = function (traeger) {
      $location.path('/traeger/'+traeger.id);
    };

}]);