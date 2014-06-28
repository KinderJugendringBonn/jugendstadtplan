var jugendstadtplanApi = angular.module('jugendstadtplan.api', ['ngResource']);

jugendstadtplanApi.provider('Pin', function() {
    this.$get = ['$resource', function ($resource) {
        var backendUrl = '/backend/orte';
        var Pin = $resource(backendUrl, {}, {
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
        return Pin;
    }];
});

jugendstadtplanApi.factory('TraegerApi', ['$resource', function ($resource) {
	return $resource('/backend/traeger/:id', { id:'@id'});
}]);

jugendstadtplanApi.factory('AngeboteApi', ['$resource', function ($resource) {
	return $resource('/backend/angebote/:id', { id:'@id'});
}]);