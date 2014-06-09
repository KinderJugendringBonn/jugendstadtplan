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
        angular.forEach(traegerDetail.orte, function(item, key) {
            var marker = {
                lat: item.latitude,
                lng: item.longitude,
                title: item.titel,
                message: '<h3>' + item.titel + '</h3>' + item.beschreibung + '<small><a href="' + '/#/ort/'+item.id + '">Mehr</a></small>'
            };
            $scope.markers.push(marker);
        });
    });
}]);