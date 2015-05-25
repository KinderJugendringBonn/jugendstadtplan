Jugendstadtplan.Controllers.controller( 'LinksFormController', [ '$scope',
    function($scope) {
        // Links
        // Links
        $scope.newLink = {};
        $scope.addLink = function() {
            if ($scope.model.links === undefined) {
                $scope.model.links = [];
            }
            $scope.model.links.push($scope.newLink);
            $scope.newLink = {};
        };

        $scope.isLinkValid = function(link) {
            if (link.titel === undefined || link.titel.length === 0) {
                return false;
            } else if (link.url === undefined || link.url.length === 0) {
                return false;
            }
            return true;
        };
    }]);