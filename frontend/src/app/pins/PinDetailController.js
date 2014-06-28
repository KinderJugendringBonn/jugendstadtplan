angular.module('jugendstadtplan.pins').config(function config( $stateProvider ) {
  
  $stateProvider.state( 'Detail: Pin', {
    url: '/pin/{id:[0-9]+}',
    views: {
      "main": {
        controller: 'PinDetailController',
        templateUrl: 'pins/views/detail.tpl.html'
      }
    },
    resolve: {
      pinDetail: [ '$stateParams', 'Pin', function($stateParams, Pin) {
        return Pin.get({},{id: $stateParams.id});
      }]
    },
    data:{ pageTitle: 'Pin' }
  });

});

Jugendstadtplan.Controllers.controller( 'PinDetailController', [ '$scope', 'pinDetail', function PinDetailController( $scope, pinDetail ) {
    $scope.markers = [];
    $scope.center = {
        lat: 50.732829246726,
        lng: 7.0937004090117,
        zoom: 13
    };

    pinDetail.$promise.then(function() {
            $scope.pin = pinDetail;

            angular.extend($scope, {
                defaults: {
                    scrollWheelZoom: false
                }
            });

            $scope.center = {
                lat: pinDetail.latitude,
                lng: pinDetail.longitude,
                zoom: 15
            };

            var marker = {
                lat: pinDetail.latitude,
                lng: pinDetail.longitude,
                title: pinDetail.titel,
                focus: true,
                message: '<h3>' + pinDetail.titel + '</h3>' + pinDetail.beschreibung,
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