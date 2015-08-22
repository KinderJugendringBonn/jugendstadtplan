angular.module( 'jugendstadtplan.ansprechpartner', [
]);
angular.module( 'jugendstadtplan.pins', [
  'ui.router', 'jugendstadtplan.adresse', 'jugendstadtplan.ansprechpartner', 'jugendstadtplan.links', 'jugendstadtplan.termin'
]);
angular.module( 'jugendstadtplan.adresse', [
]);
angular.module( 'jugendstadtplan.links', [
]);
angular.module( 'jugendstadtplan.startseite', [
  'ui.router',
  'leaflet-directive'
]);
angular.module( 'jugendstadtplan.termin', [
]);
angular.module( 'jugendstadtplan.traeger', [
  'ui.router', 'jugendstadtplan.adresse', 'jugendstadtplan.ansprechpartner', 'jugendstadtplan.links'
]);
var Jugendstadtplan = Jugendstadtplan || {};
Jugendstadtplan.Controllers = angular.module('jugendstadtplan.controllers', []);

angular.module( 'jugendstadtplan', [
  'ngResource',
  'ngSanitize',
  'ui.router',
  'leaflet-directive',
  'textAngular',
  'angularFileUpload',
  'jugendstadtplan.api',
  'jugendstadtplan.startseite',
  'jugendstadtplan.pins',
  'jugendstadtplan.traeger',
  'jugendstadtplan.controllers'
])

.config( function myAppConfig ( $stateProvider, $urlRouterProvider ) {
  $urlRouterProvider.otherwise( '/startseite' );
})

.run( function run () {
})

.controller( 'AppCtrl', [ '$scope', '$location', function AppCtrl( $scope, $location ){
  $scope.$on('$stateChangeSuccess', function(event, toState, toParams, fromState, fromParams){
    if ( angular.isDefined( toState.data.pageTitle ) ) {
      $scope.pageTitle = toState.data.pageTitle + ' | Jugendstadtplan' ;
    }
  });
}])

;
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
angular.module('jugendstadtplan.pins').config(function config( $stateProvider ) {
  
  $stateProvider.state( 'Detail: Pin', {
    url: '/pin/{id:[0-9]+}',
    views: {
      "main": {
        controller: 'PinDetailController',
        templateUrl: 'src/app/pins/views/detail.tpl.html'
      }
    },
    resolve: {
      pinDetail: [ '$stateParams', 'Pin', function($stateParams, Pin) {
        return Pin.get({},{id: $stateParams.id});
      }]
    },
    data:{ pageTitle: 'Pin' }
  });

});

Jugendstadtplan.Controllers.controller( 'PinDetailController', [ '$scope', 'pinDetail', function PinDetailController( $scope, pinDetail ) {
    $scope.markers = [];
    $scope.center = {
        lat: 50.732829246726,
        lng: 7.0937004090117,
        zoom: 13
    };

    pinDetail.$promise.then(function() {
            $scope.pin = pinDetail;

            angular.extend($scope, {
                defaults: {
                    scrollWheelZoom: false
                }
            });

            $scope.center = {
                lat: pinDetail.latitude,
                lng: pinDetail.longitude,
                zoom: 15
            };

            var marker = {
                lat: pinDetail.latitude,
                lng: pinDetail.longitude,
                title: pinDetail.titel,
                focus: true,
                message: '<h3>' + pinDetail.titel + '</h3>' + pinDetail.beschreibung,
            };
            $scope.markers.push(marker);
        }, function() {
            angular.extend($scope, {
                defaults: {
                    scrollWheelZoom: false
                }
            });
        }
    );
}]);
angular.module('jugendstadtplan.pins').config(function config( $stateProvider ) {

    $stateProvider.state( 'Form: Pin', {
        url: '/pin/create',
        views: {
            "main": {
                controller: 'PinFormController',
                templateUrl: 'src/app/pins/views/form.tpl.html'
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



}]);
angular.module('jugendstadtplan.pins').config(function config( $stateProvider ) {
  
  $stateProvider.state( 'Liste: Pin', {
    url: '/pins',
    views: {
      "main": {
        controller: 'PinsController',
        templateUrl: 'src/app/pins/views/list.tpl.html'
      }
    },
    data:{ pageTitle: 'Pins' }
  });

});

Jugendstadtplan.Controllers.controller( 'PinsController', [ '$scope', '$location', 'Pin', function PinsController( $scope, $location, Pin ) {
    $scope.pins = Pin.query();

    $scope.viewPin = function (pin) {
      $location.path('/pin/'+pin.id);
    };

}]);
Jugendstadtplan.Controllers.controller( 'AdresseFormController', [ '$scope',
    function($scope) {


    }]);
Jugendstadtplan.Controllers.controller( 'LinksFormController', [ '$scope',
    function($scope) {

        // Links
        $scope.newLink = {};
        $scope.addLink = function() {
            if ($scope.model.links === undefined) {
                $scope.model.links = [];
            }
            $scope.model.links.push($scope.newLink);
            $scope.newLink = {};
        };

        $scope.isLinkValid = function(link) {
            if (link.titel === undefined || link.titel.length === 0) {
                return false;
            } else if (link.url === undefined || link.url.length === 0) {
                return false;
            }
            return true;
        };

    }]);
angular.module('jugendstadtplan.startseite').config(function config( $stateProvider ) {
  
  $stateProvider.state( 'Startseite', {
    url: '/startseite',
    views: {
      "main": {
        controller: 'StartseiteController',
        templateUrl: 'src/app/startseite/views/startseite.tpl.html'
      }
    },
    data:{ pageTitle: 'Startseite' }
  });

});

angular.module('jugendstadtplan.startseite').controller( 'StartseiteController', [ '$scope', '$location', 'Pin', function StartseiteController( $scope, $location, Pin ) {
     angular.extend($scope, {
        center: {
            lat: 50.732829246726,
            lng: 7.0937004090117,
            zoom: 13
        },
        defaults: {
            scrollWheelZoom: false
        }
    });

    $scope.markers = [];

    Pin.query(function(pins) {
        angular.forEach(pins, function(item) {
            if (item.longitude != null) {
                var marker = {
                    lat: item.latitude,
                    lng: item.longitude,
                    title: item.titel,
                    message: '<h3>' + item.titel + '</h3>' + item.beschreibung + '<small><a href="' + '/#/pin/' + item.id + '">Mehr</a></small>'
                };
                $scope.markers.push(marker);
            }
        });
    });

}]);
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
angular.module('jugendstadtplan.traeger').config(function config( $stateProvider ) {
  
  $stateProvider.state( 'Liste: Traeger', {
    url: '/traeger',
    views: {
      "main": {
        controller: 'TraegerController',
        templateUrl: 'src/app/traeger/views/liste.tpl.html'
      }
    },
    data:{ pageTitle: 'Träger' }
  });

});

Jugendstadtplan.Controllers.controller( 'TraegerController', [ '$scope', '$location', 'Traeger', function TraegerController( $scope, $location, Traeger ) {
    $scope.traeger = Traeger.query();

    $scope.viewTraeger = function (traeger) {
      $location.path('/traeger/'+traeger.id);
    };

}]);
angular.module('jugendstadtplan.traeger').config(function config( $stateProvider ) {
  
  $stateProvider.state( 'Detail: Traeger', {
    url: '/traeger/{id:[0-9]+}',
    views: {
      "main": {
        controller: 'TraegerDetailController',
        templateUrl: 'src/app/traeger/views/detail.tpl.html'
      }
    },
    resolve: {
      traegerDetail: [ '$stateParams', 'Traeger', function($stateParams, Traeger) {
        return Traeger.get({},{id: $stateParams.id});
      }]
    },
    data:{ pageTitle: 'Träger' }
  });

});

Jugendstadtplan.Controllers.controller( 'TraegerDetailController', [ '$scope', 'traegerDetail', function TraegerDetailController( $scope, traegerDetail ) {
    $scope.traeger = traegerDetail;

    angular.extend($scope, {
        center: {
            lat: 50.732829246726,
            lng: 7.0937004090117,
            zoom: 13
        },
        defaults: {
            scrollWheelZoom: false
        }
    });

    $scope.markers = [];

    traegerDetail.$promise.then(function() {
        angular.forEach(traegerDetail.pins, function(item, key) {
            var marker = {
                lat: item.latitude,
                lng: item.longitude,
                title: item.titel,
                message: '<h3>' + item.titel + '</h3>' + item.beschreibung + '<small><a href="' + '/#/pin/'+item.id + '">Mehr</a></small>'
            };
            $scope.markers.push(marker);
        });
    });
}]);
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
                url: 'app_dev.php/img/upload', //upload.php script, node.js route, or servlet url
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
        } else if (adresse.ort === undefined || adresse.ort.length === 0) {
            return false;
        }
        return true;
    };

}]);
angular.module( 'plusOne', [] )

.directive( 'plusOne', function() {
  return {
    link: function( scope, element, attrs ) {
      gapi.plusone.render( element[0], {
        "size": "medium",
        "href": "http://bit.ly/ngBoilerplate"
      });
    }
  };
})

;


var jugendstadtplanApi = angular.module('jugendstadtplan.api', ['ngResource']);

var backendPrefix = '/app_dev.php';

jugendstadtplanApi.provider('Pin', function() {
    this.$get = ['$resource', function ($resource) {
        var backendUrl = backendPrefix + '/pins';
        return $resource(backendUrl, {}, {
            get: {
                method: 'GET',
                url: backendUrl + '/:id',
                params: { id:'@id'}
            },
            update: {
                method: 'PUT',
                url: backendUrl + '/update/:id',
                params: { id:'@id'}
            },
            save: {
                method: 'POST',
                url: backendUrl + '/create'
            },
            delete: {
                method: 'DELETE',
                url: backendUrl + '/delete/:id',
                params: { id:'@id'}
            }
        });
    }];
});

jugendstadtplanApi.provider('Traeger', function() {
    this.$get = ['$resource', function ($resource) {
        var backendUrl = backendPrefix + '/traeger';
        return $resource(backendUrl, {}, {
            get: {
                method: 'GET',
                url: backendUrl + '/:id',
                params: { id:'@id'}
            },
            update: {
                method: 'PUT',
                url: backendUrl + '/update/:id',
                params: { id:'@id'}
            },
            save: {
                method: 'POST',
                url: backendUrl + '/create'
            },
            delete: {
                method: 'DELETE',
                url: backendUrl + '/delete/:id',
                params: { id:'@id'}
            }
        });
    }];
});

jugendstadtplanApi.provider('Kategorie', function() {
    this.$get = ['$resource', function ($resource) {
        var backendUrl = backendPrefix + '/kategorie';
        return $resource(backendUrl);
    }];
});