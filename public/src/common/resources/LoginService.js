var jugendstadtplanLogin = angular.module('jugendstadtplan.login', []);

jugendstadtplanLogin.service('LoginService', ['$window', 'jwtHelper', function($window, jwtHelper) {
    var LoginService = {
        authenticated: false,
        traeger: null
    };

    LoginService.getToken = function(){
        var token = $window.localStorage.getItem('jspToken');
        if (token !== undefined) {
            return token;
        }
    };
    LoginService.setToken = function(token) {
        $window.localStorage.setItem('jspToken', token);
    };

    LoginService.isTokenExpired = function() {
        var token = this.getToken();
        if (token) {
            return jwtHelper.isTokenExpired(token);
        }

        return true;
    };

    LoginService.getJugendstadtplanUser = function() {
        return this.traeger;
    };
    LoginService.setJugendstadtplanUser = function(user) {
        this.traeger = user;
    };

    LoginService.isLoggedIn = function() {
        return this.authenticated;
    };
    LoginService.login = function(token) {
        this.authenticated = true;
        this.setToken(token);

        var decoded = jwtHelper.decodeToken(token);
        this.setJugendstadtplanUser(decoded.traeger);
    };
    LoginService.logout = function() {
        this.traeger = null;
        this.authenticated = false;
        $window.localStorage.removeItem('jspToken');
    };
    LoginService.init = function() {
        var token = this.getToken();
        if (token !== undefined) {
            if (this.isTokenExpired()) {
                this.logout();
            } else {
                this.login(token);
            }
        }
    };

    return LoginService;
}]);