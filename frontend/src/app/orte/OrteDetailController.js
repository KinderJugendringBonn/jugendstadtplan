angular.module('jugendstadtplan.orte').config(function config( $stateProvider ) {
  
  $stateProvider.state( 'Detail: Ort', {
    url: '/ort/:id',
    views: {
      "main": {
        controller: 'OrtDetailController',
        templateUrl: 'orte/views/detail.tpl.html'
      }
    },
    resolve: {
      ortDetail: [ '$stateParams', 'OrteApi', function($stateParams, $orteApi) {
        return $orteApi.get({},{id: $stateParams.id});
      }]
    },
    data:{ pageTitle: 'Ort' }
  });

});

Jugendstadtplan.Controllers.controller( 'OrtDetailController', [ '$scope', 'ortDetail', function OrtDetailController( $scope, ortDetail ) {
    $scope.ort = ortDetail;
}]);