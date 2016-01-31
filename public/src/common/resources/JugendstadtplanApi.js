var jugendstadtplanApi = angular.module('jugendstadtplan.api', ['ngResource']);

function LoginInterceptor($window){
    return {
        request: function(config) {
            if ($window.localStorage.token) {
                config.headers.Authorization = 'Bearer ' + $window.localStorage.token;
            }

            return config;
        }
    }
}

var backendPrefix = 'http://api.jugendstadtplan.dev';

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
                params: { id:'@id'},
                interceptor: LoginInterceptor
            },
            save: {
                method: 'POST',
                url: backendUrl + '/create',
                interceptor: LoginInterceptor
            },
            delete: {
                method: 'DELETE',
                url: backendUrl + '/delete/:id',
                params: { id:'@id'},
                interceptor: LoginInterceptor
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
                params: { id:'@id'},
                interceptor: LoginInterceptor
            },
            save: {
                method: 'POST',
                url: backendUrl + '/create'
            },
            delete: {
                method: 'DELETE',
                url: backendUrl + '/delete/:id',
                params: { id:'@id'},
                interceptor: LoginInterceptor
            },
            login: {
                method: 'POST',
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