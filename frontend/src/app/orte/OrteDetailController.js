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
    $scope.markers = [];
    $scope.center = {
        lat: 50.732829246726,
        lng: 7.0937004090117,
        zoom: 13
    };

    ortDetail.$promise.then(function() {
            angular.extend($scope, {
                defaults: {
                    scrollWheelZoom: false
                }
            });

            var marker = {
                lat: ortDetail.latitude,
                lng: ortDetail.longitude,
                title: ortDetail.titel,
                focus: true,
                message: '<h3>' + ortDetail.titel + '</h3>' + ortDetail.beschreibung,
                zoom: 15
            };
            $scope.center = marker;
            $scope.markers.push(marker);
        }, function() {
            angular.extend($scope, {
                defaults: {
                    scrollWheelZoom: false
                }
            });
        }
    );
}]);