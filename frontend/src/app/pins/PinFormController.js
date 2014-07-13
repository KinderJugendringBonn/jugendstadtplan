angular.module('jugendstadtplan.pins').config(function config( $stateProvider ) {

    $stateProvider.state( 'Form: Pin', {
        url: '/pin/create',
        views: {
            "main": {
                controller: 'PinFormController',
                templateUrl: 'pins/views/form.tpl.html'
            }
        },
        data:{ pageTitle: 'Pin erstellen' }
    });

});

Jugendstadtplan.Controllers.controller( 'PinFormController', [ '$scope', '$location', 'Pin', 'Traeger', function PinFormController( $scope, $location, Pin, Traeger ) {
    $scope.pin = new Pin();
    $scope.pins = Pin.query();
    $scope.traegers = Traeger.query();

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

    $scope.pin.markers = [];
    $scope.$on("leafletDirectiveMap.click", function(event, args){
        var leafEvent = args.leafletEvent;

        $scope.pin.markers[0] = {
            lat: leafEvent.latlng.lat,
            lng: leafEvent.latlng.lng,
            draggable: true,
            focus: true
        };
    });

    $scope.newPin = function() {
        $scope.pin = new Pin();
        $scope.pin.markers = [];
        $scope.editing = false;
    };

    $scope.save = function() {
        if ($scope.pin.id) {
            Pin.update($scope.pin);
        } else {
            $scope.pin.$save().then(function(response) {
                $scope.pins.push(response);
            });
        }
        $scope.newPin();
    };

    $scope.setActivePin = function(pin) {
        $scope.pin = pin;
        $scope.pin.markers = [];
        if (pin.longitude != null) {
            $scope.pin.markers[0] = {
                lat: pin.latitude,
                lng: pin.longitude,
                draggable: true,
                focus: true
            };
        }
        $scope.editing = true;
    };

    $scope.remove = function(pin) {
        Pin.delete(pin, function() {
            var index = $scope.pins.indexOf(pin);
            if (index != -1) {
                $scope.pins.splice(index, 1);
            }
        });
    };

}]);