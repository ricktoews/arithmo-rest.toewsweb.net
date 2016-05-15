var app = angular.module("dcApp", ["ngRoute"]);

app.controller("AppCtrl", ["$scope", "$http", "$routeParams", "decimalCalc", function($scope, $http, $routeParams, decimalCalc) {
    
console.log("Route params", $routeParams);
    $scope.calculate = function() {
        var denom = $scope.denom;
        decimalCalc.list(denom)
            .success(function(response) {
                $scope.dclist = response;
            });
    }

}]);

app.config(["$routeProvider", "$locationProvider", function($routeProvider, $locationProvider) {
console.log("Turning on html 5 mode");
    $locationProvider.html5Mode(true);
    $routeProvider
        .when("decimal.html/:denom", {
            templateUrl: "decimal.html",
            controller: "AppCtrl"
        })

        .otherwise({
            redirectTo: "/"
        });
}]);


app.service("decimalCalc", ["$http", function($http) {

    this.list = function(denom) {
        return $http.get("/dc/" + denom);
    }
}]);

