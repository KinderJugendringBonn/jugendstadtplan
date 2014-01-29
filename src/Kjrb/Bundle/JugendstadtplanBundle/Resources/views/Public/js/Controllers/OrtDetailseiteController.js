var app = angular.module("OrtDetailseite", ["leaflet-directive"]);

app.controller("OrtDetailseiteController", [ '$scope', function($scope) {

    angular.extend($scope, {
        center: {
            lat: 50.732829246726, // Default-Werte, werden vom Model ueberschrieben.
            lng: 7.0937004090117, // Default-Werte, werden vom Model ueberschrieben.
            zoom: 15
        },
        defaults: {
            scrollWheelZoom: false
        },
        markers: {
            default_marker: {
                lat: 50.732829246726,
                lng: 7.0937004090117,
                message: "",
                focus: true
            }
        }
    });
}]);