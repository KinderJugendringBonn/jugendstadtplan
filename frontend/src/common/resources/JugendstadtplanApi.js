var jugendstadtplanApi = angular.module('jugendstadtplan.api', ['ngResource']);

jugendstadtplanApi.factory('OrteApi', ['$resource', function ($resource) {
	return $resource('/backend/orte/:id', { id:'@id'});
}]);

jugendstadtplanApi.factory('TraegerApi', ['$resource', function ($resource) {
	return $resource('/backend/traeger/:id', { id:'@id'});
}]);

jugendstadtplanApi.factory('AngeboteApi', ['$resource', function ($resource) {
	return $resource('/backend/angebote/:id', { id:'@id'});
}]);