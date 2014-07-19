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

Jugendstadtplan.Controllers.controller( 'PinFormController', [ '$scope', '$location', 'Pin', 'Traeger', 'Kategorie', function PinFormController( $scope, $location, Pin, Traeger, Kategorie ) {
    $scope.kategorien = Kategorie.query();
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


    // Barrierefreiheitsgrade
    $scope.barrierefreiheitsgrade = [ 'Gut', 'Teilweise', 'Nicht barrierefrei' ];


    // Kostenarten
    $scope.kostenarten = [ 'Kostenlos', 'Kostenpflichtig' ];


    // Mindestalter
    $scope.mindestalters = [ 'ab 12', 'ab 16', 'ab 18', 'ab 21' ];


    // Ansprechpartner
    $scope.newAnsprechpartner = {};
    $scope.addAnsprechpartner = function() {
        if ($scope.pin.ansprechpartner === undefined) {
            $scope.pin.ansprechpartner = [];
        }
        $scope.pin.ansprechpartner.push($scope.newAnsprechpartner);
        $scope.newAnsprechpartner = {};
    };

    $scope.isAnsprechpartnerValid = function(ansprechpartner) {
        if (ansprechpartner.name === undefined || ansprechpartner.name.length === 0) {
            return false;
        }
        if (ansprechpartner.email === undefined || ansprechpartner.email.length === 0) {
            return false;
        }
        return true;
    };


    // Wochentage
    $scope.wochentage = [ 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag' ];


    // Termin
    $scope.newTermin = {};
    $scope.addTermin = function() {
        if ($scope.pin.termine === undefined) {
            $scope.pin.termine = [];
        }
        $scope.pin.termine.push($scope.newTermin);
        $scope.newTermin = {};
    };

    $scope.isTerminValid = function(termin) {
        if (termin.beginn === undefined || termin.beginn === 0) {
            return false;
        }
        if (termin.ganztaegig !== true && (termin.beginn_uhrzeit === undefined || termin.beginn_uhrzeit === 0)) {
            return false;
        }
        return true;
    };


    // Wiederholung
    $scope.woche_des_monats = [
        { id: 0, label: 'Jede Woche' },
        { id: 1, label: 'Jede 1. Woche' },
        { id: 2, label: 'Jede 2. Woche' },
        { id: 3, label: 'Jede 3. Woche' },
        { id: 4, label: 'Jede 4. Woche' },
        { id: 5, label: 'Jede 5. Woche' }
    ];
    $scope.newWiederholung = {};
    $scope.addWiederholung = function() {
        if ($scope.newTermin.wiederholungen === undefined) {
            $scope.newTermin.wiederholungen = [];
        }
        $scope.newTermin.wiederholungen.push($scope.newWiederholung);
        $scope.newWiederholung = {};
    };

    $scope.isWiederholungValid = function(wiederholung) {
        if (wiederholung.wochentag === undefined || wiederholung.wochentag === 0) {
            return false;
        }
        return true;
    };


    // Links
    $scope.newLink = {};
    $scope.addLink = function() {
        if ($scope.pin.links === undefined) {
            $scope.pin.links = [];
        }
        $scope.pin.links.push($scope.newLink);
        $scope.newLink = {};
    };

    $scope.isLinkValid = function(link) {
        if (link.titel === undefined || link.titel.length === 0) {
            return false;
        }
        if (link.url === undefined || link.url.length === 0) {
            return false;
        }
        return true;
    };

}]);