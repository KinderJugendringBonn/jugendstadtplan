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

app.controller("OrtErstellenController", [ '$scope', function($scope) {

    angular.extend($scope, {
        center: {
            lat: 50.732829246726,
            lng: 7.0937004090117,
            zoom: 13
        },
        defaults: {
            scrollWheelZoom: false
        },
        events: {}
    });

    $scope.markers = new Array();

    $scope.$on("leafletDirectiveMap.click", function(event, args){
        var leafEvent = args.leafletEvent;

        $scope.markers[0] = {
            lat: leafEvent.latlng.lat,
            lng: leafEvent.latlng.lng,
            draggable: true,
            focus: true
        };
    });

}]);

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