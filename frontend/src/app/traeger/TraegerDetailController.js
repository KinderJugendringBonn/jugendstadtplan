angular.module('jugendstadtplan.traeger').config(function config( $stateProvider ) {
  
  $stateProvider.state( 'Detail: Traeger', {
    url: '/traeger/:id',
    views: {
      "main": {
        controller: 'TraegerDetailController',
        templateUrl: 'traeger/views/detail.tpl.html'
      }
    },
    resolve: {
      traegerDetail: [ '$stateParams', 'TraegerApi', function($stateParams, $traegerApi) {
        return $traegerApi.get({},{id: $stateParams.id});
      }]
    },
    data:{ pageTitle: 'Träger' }
  });

});

Jugendstadtplan.Controllers.controller( 'TraegerDetailController', [ '$scope', 'traegerDetail', function OrtDetailController( $scope, traegerDetail ) {
    $scope.traeger = traegerDetail;
}]);