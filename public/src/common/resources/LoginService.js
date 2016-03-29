var jugendstadtplanLogin = angular.module('jugendstadtplan.login', []);

jugendstadtplanLogin.service('LoginService', function() {
    var authenticated = false;
    var traeger = null;

    return {
        isLoggedIn: function () {
            return authenticated;
        },

        setLoggedIn: function (loggedIn) {
            authenticated = loggedIn;
        },

        setJugendstadtplanUser: function(user) {
            traeger = user;
        },

        getJugendstadtplanUser: function() {
            return traeger;
        }
    }
});