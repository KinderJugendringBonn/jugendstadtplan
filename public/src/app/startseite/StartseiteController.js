angular.module('jugendstadtplan.startseite').config(function config( $stateProvider ) {
  
  $stateProvider.state( 'Startseite', {
    url: '/startseite',
    views: {
      "main": {
        controller: 'StartseiteController',
        templateUrl: 'app/startseite/views/startseite.tpl.html'
      }
    },
    data:{ pageTitle: 'Startseite' }
  });

});

angular.module('jugendstadtplan.startseite').controller( 'StartseiteController', [ '$scope', '$location', 'Pin', '$templateCache', function StartseiteController( $scope, $location, Pin, $templateCache ) {
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

    Pin.query(function(pins) {
        angular.forEach(pins, function(item) {
            if (item.longitude != null) {
                var marker = {
                    lat: item.latitude,
                    lng: item.longitude,
                    title: item.titel,
                    message: '<h3>' + item.titel + '</h3>' + item.beschreibung + '<small><a href="' + '/#/pin/' + item.id + '">Mehr</a></small>'
                };
                $scope.markers.push(marker);
            }
        });
    });

}]);