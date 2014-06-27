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
      ortDetail: [ '$stateParams', 'Ort', function($stateParams, Ort) {
        return Ort.get({},{id: $stateParams.id});
      }]
    },
    data:{ pageTitle: 'Ort' }
  });

});

Jugendstadtplan.Controllers.controller( 'OrtDetailController', [ '$scope', 'ortDetail', function OrtDetailController( $scope, ortDetail ) {
    $scope.markers = [];
    $scope.center = {
        lat: 50.732829246726,
        lng: 7.0937004090117,
        zoom: 13
    };

    ortDetail.$promise.then(function() {
            $scope.ort = ortDetail;

            angular.extend($scope, {
                defaults: {
                    scrollWheelZoom: false
                }
            });

            $scope.center = {
                lat: ortDetail.latitude,
                lng: ortDetail.longitude,
                zoom: 15
            };

            var marker = {
                lat: ortDetail.latitude,
                lng: ortDetail.longitude,
                title: ortDetail.titel,
                focus: true,
                message: '<h3>' + ortDetail.titel + '</h3>' + ortDetail.beschreibung,
            };
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