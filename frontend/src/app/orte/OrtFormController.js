angular.module('jugendstadtplan.orte').config(function config( $stateProvider ) {

    $stateProvider.state( 'Form: Ort', {
        url: '/ort/create',
        views: {
            "main": {
                controller: 'OrtFormController',
                templateUrl: 'orte/views/form.tpl.html'
            }
        },
        data:{ pageTitle: 'Ort erstellen' }
    });

});

Jugendstadtplan.Controllers.controller( 'OrtFormController', [ '$scope', '$location', 'Ort', function OrteController( $scope, $location, Ort ) {
    $scope.ort = new Ort();
    $scope.orte = Ort.query();

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

    $scope.ort.markers = [];
    $scope.$on("leafletDirectiveMap.click", function(event, args){
        var leafEvent = args.leafletEvent;

        $scope.ort.markers[0] = {
            lat: leafEvent.latlng.lat,
            lng: leafEvent.latlng.lng,
            draggable: true,
            focus: true
        };
    });

    $scope.newOrt = function() {
        $scope.ort = new Ort();
        $scope.ort.markers = [];
        $scope.editing = false;
    };

    $scope.save = function() {
        if ($scope.ort.id) {
            Ort.update({id: $scope.ort.id}, $scope.ort);
        } else {
            $scope.ort.$save().then(function(response) {
                $scope.orte.push(response);
            });
        }
        $scope.newOrt();
    };

    $scope.setActiveOrt = function(ort) {
        $scope.ort = ort;
        $scope.ort.markers = [];
        $scope.ort.markers[0] = {
            lat: ort.latitude,
            lng: ort.longitude,
            draggable: true,
            focus: true
        };
        $scope.editing = true;
    };

    $scope.remove = function(ort, $index) {
        Ort.delete(ort);
        $scope.orte.splice($index, 1);
    };

}]);