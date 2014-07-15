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

Jugendstadtplan.Controllers.controller( 'TraegerFormController', [ '$scope', '$location', 'Traeger', 'Kategorie', function TraegerFormController( $scope, $location, Traeger, Kategorie ) {
    $scope.kategorien = Kategorie.query();
    $scope.traeger = new Traeger();
    $scope.traegers = Traeger.query();

    $scope.newTraeger = function() {
        $scope.traeger = new Traeger();
        $scope.editing = false;
    };

    $scope.save = function() {
        if ($scope.traeger.id) {
            Traeger.update($scope.traeger).then(function() {
                $scope.newTraeger();
            }, function() {
                alert('Ein Träger mit dieser Email-Adresse existiert bereits!');
            });
        } else {
            $scope.traeger.$save().then(function(response) {
                $scope.traegers.push(response);
                $scope.newTraeger();
            }, function() {
                alert('Ein Träger mit dieser Email-Adresse existiert bereits!');
            });
        }
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


    // Ansprechpartner
    $scope.newAnsprechpartner = {};
    $scope.addAnsprechpartner = function() {
        if ($scope.traeger.ansprechpartner === undefined) {
            $scope.traeger.ansprechpartner = [];
        }
        $scope.traeger.ansprechpartner.push($scope.newAnsprechpartner);
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


    // Links
    $scope.newLink = {};
    $scope.addLink = function() {
        if ($scope.traeger.links === undefined) {
            $scope.traeger.links = [];
        }
        $scope.traeger.links.push($scope.newLink);
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


    // Adressen
    $scope.newAdresse = {};
    $scope.addAdresse = function() {
        if ($scope.traeger.adressen === undefined) {
            $scope.traeger.adressen = [];
        }
        $scope.traeger.adressen.push($scope.newAdresse);
        $scope.newAdresse = {};
    };

    $scope.isAdresseValid = function(adresse) {
        if (adresse.strasse === undefined || adresse.strasse.length === 0) {
            return false;
        }
        if (adresse.ort === undefined || adresse.ort.length === 0) {
            return false;
        }
        return true;
    };

}]);