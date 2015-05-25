angular.module('jugendstadtplan.traeger').config(function config( $stateProvider ) {

    $stateProvider.state( 'Form: Traeger', {
        url: '/traeger/create',
        views: {
            "main": {
                controller: 'TraegerFormController',
                templateUrl: 'src/app/traeger/views/form.tpl.html'
            }
        },
        data:{ pageTitle: 'Träger erstellen' }
    });

});

Jugendstadtplan.Controllers.controller( 'TraegerFormController', [ '$scope', '$location', 'Traeger', 'Kategorie', '$upload', function TraegerFormController( $scope, $location, Traeger, Kategorie, $upload ) {
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

    // Bilder
    $scope.onFileSelect = function($files) {
        var doUpload = function(file) {
            $upload.upload({
                url: 'backend/img/upload', //upload.php script, node.js route, or servlet url
                // method: 'POST' or 'PUT',
                method: 'POST',
                // headers: {'header-key': 'header-value'},
                // withCredentials: true,
                data: {myObj: $scope.myModelObj},
                file: file // or list of files: $files for html5 only
                // fileName: 'doc.jpg' or ['1.jpg', '2.jpg', ...] // to modify the name of the file
                /* customize file formData name ('Content-Desposition'), server side file variable name.
                 Default is 'file' */
                //fileFormDataName: myFile, //or a list of names for multiple files (html5).
                /* customize how data is added to formData. See #40#issuecomment-28612000 for sample code */
                //formDataAppender: function(formData, key, val){}
            }).progress(function (evt) {
                console.log('percent: ' + parseInt(100.0 * evt.loaded / evt.total));
            }).success(function (data, status, headers, config) {
                // file is uploaded successfully
                if ($scope.traeger.bilder === undefined) {
                    $scope.traeger.bilder = [];
                }
                file.tmp_name = data.folder;
                $scope.traeger.bilder.push(file);
            });
            //.error(...)
            //.then(success, error, progress);
            //.xhr(function(xhr){xhr.upload.addEventListener(...)})// access and attach any event listener to XMLHttpRequest.
        };

        //$files: an array of files selected, each file has name, size, and type.
        for (var i = 0; i < $files.length; i++) {
            var file = $files[i];
            $scope.upload = doUpload(file);
        }
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