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
            var ort = angebotDetail.ort;
            angular.extend($scope, {
                defaults: {
                    scrollWheelZoom: false
                }
            });

            var marker = {
                lat: ort.latitude,
                lng: ort.longitude,
                title: ort.titel,
                focus: true,
                message: '<h3>' + ort.titel + '</h3>' + ort.beschreibung,
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