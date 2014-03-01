angular.module( 'ngBoilerplate.orte', [
  'ui.router',
  'ui.bootstrap'
])

.config(function config( $stateProvider ) {
  
  $stateProvider.state( 'orte', {
    url: '/orte',
    views: {
      "main": {
        controller: 'OrteController',
        templateUrl: 'orte/views/orte.tpl.html'
      }
    },
    data:{ pageTitle: 'Orte' }
  })
  .state( 'detail', {
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
  })
  ;


})

.controller( 'OrteController', [ '$scope', '$location', 'OrteApi', function OrteController( $scope, $location, $orteApi ) {
    $scope.orte = $orteApi.query();

    $scope.viewOrt = function (ort) {
      $location.path('/ort/'+ort.id);
    };

}])

.controller( 'OrtDetailController', [ '$scope', 'ortDetail', function OrtDetailController( $scope, ortDetail ) {
    $scope.ort = ortDetail;
}])
;
