angular.module('jugendstadtplan.startseite').config(function config( $stateProvider ) {
  
  $stateProvider.state( 'Startseite', {
    url: '/startseite',
    views: {
      "main": {
        controller: 'StartseiteController',
        templateUrl: 'startseite/views/startseite.tpl.html'
      }
    },
    data:{ pageTitle: 'Startseite' }
  });

});

angular.module('jugendstadtplan.startseite').controller( 'StartseiteController', [ '$scope', '$location', 'OrteApi', function StartseiteController( $scope, $location, $orteApi ) {
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

    $orteApi.query(function(orte) {
        angular.forEach(orte, function(item) {
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