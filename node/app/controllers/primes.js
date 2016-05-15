var primeApp = angular.module("primeApp", []);

primeApp.controller("AppCtrl", ["$scope", "$http", function($scope, $http) {

    $scope.factor = function() {
        var factorme = $scope.factorme;
        $http.get("/factor/" + factorme)
            .success(function(response) {
                $scope.factorlist = response.primeFactors.join(",");
            });
    }

    $scope.getPrimes = function() {
        var paramList = [$scope.primefrom, $scope.primeto];
        paramList.push($scope.primemod);
        var params = paramList.join("/");
        $http.get("/primes/" + params)
            .success(function(response) {
                $scope.grouped = !!response.prime_groups;
                if ($scope.grouped) {
                    $scope.primeList = response.prime_groups;
                }
                else {
                    $scope.primeCount = response.count;
                    $scope.primeList = response.primes;
                }
            });
    }

}]);


