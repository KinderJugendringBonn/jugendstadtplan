Jugendstadtplan.Controllers.controller( 'TerminFormController', [ '$scope',
    function($scope) {

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
            } else if (termin.ganztaegig !== true && (termin.beginn_uhrzeit === undefined || termin.beginn_uhrzeit === 0)) {
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

    }]);