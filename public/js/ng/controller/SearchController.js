/**
 * Created by Gipoy17 on 12/18/2014.
 */

var qcpuApp = angular.module('qcpuApp', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

function SearchController($scope, $http) {

    $scope.div1 = 'lo';

};