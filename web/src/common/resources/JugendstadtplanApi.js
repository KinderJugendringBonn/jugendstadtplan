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