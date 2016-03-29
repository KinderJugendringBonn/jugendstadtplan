var jugendstadtplanApi = angular.module('jugendstadtplan.api', ['ngResource', 'angular-jwt']);

jugendstadtplanApi.config(['$httpProvider', 'jwtInterceptorProvider', function($httpProvider, jwtInterceptorProvider) {

    jwtInterceptorProvider.tokenGetter = ['config', function(config) {
        // Skip authentication for any requests ending in .html
        if (config.url.substr(config.url.length - 5) == '.html') {
            return null;
        }

        return localStorage.getItem('jspToken');
    }];

    $httpProvider.interceptors.push('jwtInterceptor');
}]);

var backendPrefix = 'http://api.jugendstadtplan.dev/app_dev.php';

jugendstadtplanApi.provider('Pin', function() {
    this.$get = ['$resource', function ($resource) {
        var backendUrl = backendPrefix + '/pins';
        return $resource(backendUrl, {}, {
            get: {
                method: 'GET',
                url: backendUrl + '/:id',
                params: { id:'@id'},
                skipAuthorization: true
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
                params: { id:'@id'},
                skipAuthorization: true
            },
            update: {
                method: 'PUT',
                url: backendUrl + '/update/:id',
                params: { id:'@id'}
            },
            save: {
                method: 'POST',
                url: backendUrl + '/create',
                skipAuthorization: true
            },
            delete: {
                method: 'DELETE',
                url: backendUrl + '/delete/:id',
                params: { id:'@id'}
            },
            login: {
                method: 'POST',
                skipAuthorization: true,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                url: backendPrefix + '/authentication/traeger_check',
                transformRequest: function (data, headersGetter) {
                    // Transform JSON into regular form values
                    var str = [];
                    for (var d in data)
                        str.push(encodeURIComponent(d) + "=" + encodeURIComponent(data[d]));
                    return str.join("&");
                }
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