var app = angular.module("OrtErstellen", ["leaflet-directive"]);

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