var jugendstadtplanLogin = angular.module('jugendstadtplan.login', []);

jugendstadtplanLogin.service('LoginService', function() {
    var authenticated = false;

    return {
        isLoggedIn: function () {
            return authenticated;
        },

        setLoggedIn: function (loggedIn) {
            authenticated = loggedIn;
        }
    }
});