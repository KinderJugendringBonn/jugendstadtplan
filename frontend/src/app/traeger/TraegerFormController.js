angular.module('jugendstadtplan.traeger').config(function config( $stateProvider ) {

    $stateProvider.state( 'Form: Traeger', {
        url: '/traeger/create',
        views: {
            "main": {
                controller: 'TraegerFormController',
                templateUrl: 'traeger/views/form.tpl.html'
            }
        },
        data:{ pageTitle: 'Träger erstellen' }
    });

});

Jugendstadtplan.Controllers.controller( 'TraegerFormController', [ '$scope', '$location', 'Traeger', function TraegerFormController( $scope, $location, Traeger ) {
    $scope.traeger = new Traeger();
    $scope.traegers = Traeger.query();

    $scope.newTraeger = function() {
        $scope.traeger = new Traeger();
        $scope.editing = false;
    };

    $scope.save = function() {
        if ($scope.traeger.id) {
            Traeger.update($scope.traeger);
        } else {
            $scope.traeger.$save().then(function(response) {
                $scope.traegers.push(response);
            });
        }
        $scope.newTraeger();
    };

    $scope.setActiveTraeger = function(traeger) {
        $scope.traeger = traeger;
        $scope.editing = true;
    };

    $scope.remove = function(traeger) {
        Traeger.delete(traeger, function() {
            var index = $scope.traegers.indexOf(traeger);
            if (index != -1) {
                $scope.traegers.splice(index, 1);
            }
        });
    };

}]);