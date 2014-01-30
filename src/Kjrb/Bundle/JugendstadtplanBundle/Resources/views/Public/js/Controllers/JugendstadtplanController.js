var module = angular.module("Startseite", ["leaflet-directive"]);

module.controller("JugendstadtplanController", [ '$scope', '$http', function($scope, $http) {

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

    $scope.markers = new Array();

    $http.get('/backend/orte')
        .success(function(data) {
            angular.forEach(data, function(item) {
                var marker = {
                    lat: item.latitude,
                    lng: item.longitude,
                    title: item.titel,
                    message: '<h3>' + item.titel + '</h3>' + item.beschreibung
                };
                $scope.markers.push(marker);
            })
        })
        .error(function(data, status) {
            console.log('Das hat leider nicht geklappt. :( ' + status);
            console.log(data);
        })
    ;
}]);