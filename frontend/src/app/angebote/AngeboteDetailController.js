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
    $scope.markers = [];
    $scope.center = {
        lat: 50.732829246726,
        lng: 7.0937004090117,
        zoom: 13
    };

    angebotDetail.$promise.then(function() {
            var pin = angebotDetail.pin;
            angular.extend($scope, {
                defaults: {
                    scrollWheelZoom: false
                }
            });

            $scope.center = {
                lat: pin.latitude,
                lng: pin.longitude,
                zoom: 15
            };

            var marker = {
                lat: pin.latitude,
                lng: pin.longitude,
                title: pin.titel,
                focus: true,
                message: '<h3>' + pin.titel + '</h3>' + pin.beschreibung,
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