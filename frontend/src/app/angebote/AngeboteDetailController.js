angular.module('jugendstadtplan.angebote').config(function config( $stateProvider ) {
  
  $stateProvider.state( 'Detail: Angebot', {
    url: '/angebot/:id',
    views: {
      "main": {
        controller: 'AngebotDetailController',
        templateUrl: 'angebote/views/detail.tpl.html'
      }
    },
    resolve: {
      angebotDetail: [ '$stateParams', 'AngeboteApi', function($stateParams, $angeboteApi) {
        return $angeboteApi.get({},{id: $stateParams.id});
      }]
    },
    data:{ pageTitle: 'Angebot' }
  });

});

Jugendstadtplan.Controllers.controller( 'AngebotDetailController', [ '$scope', 'angebotDetail', function AngebotDetailController( $scope, angebotDetail ) {
    $scope.angebot = angebotDetail;
}]);