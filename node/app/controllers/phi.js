var phiApp = angular.module("phiApp", []);

phiApp.controller("AppCtrl", ["$scope", "$http", "$routeParams", function($scope, $http, $routeParams) {

    $scope.calculate = function() {
        var power = $scope.power;
        console.log(power);
        $http.get("/phi/" + power)
            .success(function(response) {
                $scope.philist = response;
            });
    }

}]);

