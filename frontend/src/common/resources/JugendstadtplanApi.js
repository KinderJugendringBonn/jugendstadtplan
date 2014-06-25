var jugendstadtplanApi = angular.module('jugendstadtplan.api', ['ngResource']);

jugendstadtplanApi.provider('Ort', function() {
    this.$get = ['$resource', function ($resource) {
        var Ort = $resource('/backend/orte/:id', {}, {
            update: {
                method: 'PUT',
                url: '/backend/orte/update/:id'
            },
            save: {
                method: 'POST',
                url: '/backend/orte/create'
            },
            delete: {
                method: 'DELETE',
                url: '/backend/orte/delete/:id'
            }
        });
        return Ort;
    }];
});

jugendstadtplanApi.factory('TraegerApi', ['$resource', function ($resource) {
	return $resource('/backend/traeger/:id', { id:'@id'});
}]);

jugendstadtplanApi.factory('AngeboteApi', ['$resource', function ($resource) {
	return $resource('/backend/angebote/:id', { id:'@id'});
}]);