<html ng-app="crudApp">  
<head>  
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>  
</head>  
<body>

<div ng-controller="crudCtrl" ng-init="allRecords()">
<table>
<thead>
<tr>
<th>Name</th>
<th>Phone</th>
</tr>
</thead>
<tbody>

<tr ng-repeat="x in columnsNames" ng-include="crudTemplate(x)">
</tr>
</tbody>
</table>

<!-- READ TEMPLATE -->               
<script type="text/ng-template" id="crudTable">
<td>{{x.name}}</td>
<td>{{x.phone}}</td>
<td>
<button type="button" ng-click="visibleEditForm(x)">Edit</button>
</td>
</script>
<!-- READ TEMPLATE THE END -->

<!-- EDIT TEMPLATE -->
                <script type="text/ng-template" id="editForm">
                    <td><input type="text" ng-model="formEdit.name" /></td>
                    <td><input type="text" ng-model="formEdit.phone" /></td>
                    <td>
                        <input type="hidden" ng-model="formEdit.x.id" />
                        <button type="button" ng-click="updateData()">Update</button>
                        <button type="button" ng-click="cancel()">Cancel</button>
                    </td>
                </script>  
<!-- EDIT TEMPLATE THE END -->
</div>
</body>  
</html>

<script>
var app = angular.module('crudApp', []);

app.controller('crudCtrl', ["$scope", "$http", function($scope, $http){

    $scope.formEdit = {};

    $scope.crudTemplate = function(x){
        
        if (x.id === $scope.formEdit.id)
        {
            return 'editForm';
        }
        return 'crudTable';
    };

    $scope.allRecords = function(){
        $http.get('read.php').success(function(x){
            $scope.columnsNames = x;
        });
    };

    $scope.visibleEditForm = function(x) {
        $scope.formEdit = angular.copy(x);
    };

    $scope.updateData = function(){
        $http({
            method:"POST",
            url:"update.php",
            data:$scope.formEdit,
        }).success(function(x){
            $scope.success = true;
            $scope.feedBack = x.feedBack;
            $scope.allRecords();
            $scope.formEdit = {};
        });
    };

    $scope.cancel = function(){
        $scope.formEdit = {};
    };
}]);

</script>
