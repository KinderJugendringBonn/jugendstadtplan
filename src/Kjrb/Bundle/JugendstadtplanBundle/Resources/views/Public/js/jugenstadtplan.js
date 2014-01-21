var app = angular.module("JugendstadtplanApp", ["leaflet-directive"]);
app.controller("JugendstadtplanController", [ '$scope', '$http', function($scope, $http) {

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


    $http.get('/app_dev.php/ort/json-liste')
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