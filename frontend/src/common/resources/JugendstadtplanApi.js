var jugendstadtplanApi = angular.module('jugendstadtplan.api', ['ngResource']);

jugendstadtplanApi.factory('OrteApi', ['$resource', function ($resource) {
	return $resource('/backend/orte/:id', { id:'@id'});
}]);