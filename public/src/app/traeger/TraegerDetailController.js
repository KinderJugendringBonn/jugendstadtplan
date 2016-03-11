angular.module('jugendstadtplan.traeger').config(['$stateProvider', function config( $stateProvider ) {
  
  $stateProvider.state( 'Detail: Traeger', {
    url: '/traeger/{id:[0-9]+}',
    views: {
      "main": {
        controller: 'TraegerDetailController',
        templateUrl: 'app/traeger/views/detail.tpl.html'
      }
    },
    resolve: {
      traegerDetail: [ '$stateParams', 'Traeger', function($stateParams, Traeger) {
        return Traeger.get({},{id: $stateParams.id});
      }]
    },
    data:{ pageTitle: 'Träger' }
  });

}]);

Jugendstadtplan.Controllers.controller( 'TraegerDetailController', [ '$scope', 'traegerDetail', function TraegerDetailController( $scope, traegerDetail ) {
    $scope.traeger = traegerDetail;

    angular.extend($scope, {
        center: {
            lat: 50.732829246726,
            lng: 7.0937004090117,
            zoom: 13
        },
        defaults: {
            scrollWheelZoom: false
        }
    });

    $scope.markers = [];

    traegerDetail.$promise.then(function() {
        angular.forEach(traegerDetail.pins, function(item, key) {
            var marker = {
                lat: item.latitude,
                lng: item.longitude,
                title: item.titel,
                message: '<h3>' + item.titel + '</h3>' + item.beschreibung + '<small><a href="' + '/#/pin/'+item.id + '">Mehr</a></small>'
            };
            $scope.markers.push(marker);
        });
    });
}]);