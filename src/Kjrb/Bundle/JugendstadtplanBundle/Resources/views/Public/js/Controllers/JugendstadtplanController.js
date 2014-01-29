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
        },
        markers: {}
    });


    $http.get('/ort/json-liste')
        .success(function(data) {
            angular.extend($scope, {
                markers: data
            });
        })
        .error(function(data, status) {
            console.log('Das hat leider nicht geklappt. :( ' + status);
            console.log(data);
        })
    ;
}]);