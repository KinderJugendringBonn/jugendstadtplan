var jugendstadtplanLogin = angular.module('jugendstadtplan.login', []);

jugendstadtplanLogin.service('LoginService', ['$window', function($window) {
    var authenticated = false;
    var traeger = null;

    return {
        isLoggedIn: function () {
            return authenticated;
        },

        setLoggedIn: function (loggedIn) {
            authenticated = loggedIn;
        },

        logout: function() {
            traeger = null;
            authenticated = false;
            $window.localStorage.removeItem('jspToken');
        },

        setJugendstadtplanUser: function(user) {
            traeger = user;
        },

        getJugendstadtplanUser: function() {
            return traeger;
        }
    }
}]);