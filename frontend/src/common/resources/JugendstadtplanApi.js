var jugendstadtplanApi = angular.module('jugendstadtplan', ['ngResource']);

jugendstadtplanApi.factory('OrteApi', ['$resource', function ($resource) {
	return $resource('/backend/orte/:id', { id:'@id'});
}]);