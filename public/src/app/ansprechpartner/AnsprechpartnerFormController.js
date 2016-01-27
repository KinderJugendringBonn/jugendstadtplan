Jugendstadtplan.Controllers.controller( 'AnsprechpartnerFormController', [ '$scope',
    function($scope) {

        // Ansprechpartner
        $scope.newAnsprechpartner = {};
        $scope.addAnsprechpartner = function() {
            if ($scope.model.ansprechpartner === undefined) {
                $scope.model.ansprechpartner = [];
            }
            $scope.model.ansprechpartner.push($scope.newAnsprechpartner);
            $scope.newAnsprechpartner = {};
        };

        $scope.isAnsprechpartnerValid = function(ansprechpartner) {
            if (ansprechpartner.name === undefined || ansprechpartner.name.length === 0) {
                return false;
            } else if (ansprechpartner.email === undefined || ansprechpartner.email.length === 0) {
                return false;
            }
            return true;
        };

    }]);