'use strict';

gbApp.controller('GuestBookController',
    function GuestBookController($scope, guestBookData) {
        $scope.entry = {};
        $scope.errors = {};
        $scope.entries = guestBookData.getAllEnties();
        $scope.editEntry = function (entry) {
            $scope.editing = JSON.parse(JSON.stringify(entry));
            console.log($scope.editing);
        };
        $scope.cancelEdit = function (entry) {
            var idx = $scope.entries.indexOf(entry);
            console.log($scope.editing);
            $scope.entries[idx] = $scope.editing;
            $scope.editing = '';
            $scope.editErrors = {};
        };
        $scope.save = function(entry) {
            $scope.editErrors = {};
            guestBookData.updateEntry(entry)
                .$promise.then(
                function (response){
                    $scope.editing = null;
                    console.log(response);
                },
                function (response) {
                    console.log('failure', response);
                    if (response.data !== null) {
                        for (var error in response.data.errors) {
                            $scope.editErrors[response.data.errors[error].field] =
                                response.data.errors[error].message;
                        }
                        console.log($scope.editErrors);
                    }
                }
            )
        };
        $scope.sign = function (entry) {
            console.log(entry);
            $scope.errors = {};
            guestBookData.newEntry(entry)
                .$promise.then(
                function(response) {
                    console.log('success', response);
                    $scope.entries.push(response);
                    $scope.entry = null;
                },
                function(response) {
                    console.log('failure', response);
                    if (response.data !== null) {
                        for (var error in response.data.errors) {
                            $scope.errors[response.data.errors[error].field] =
                                response.data.errors[error].message;
                        }
                        console.log($scope.errors);
                    }
                }
            )
        };
        $scope.delete = function(entry) {
            guestBookData.deleteEntry(entry.id);
            var index = $scope.entries.indexOf(entry);
            if (index > -1) {
                $scope.entries.splice(index,1);
            }
        }
    }
);