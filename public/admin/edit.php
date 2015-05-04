<!DOCTYPE html>
<html >
<style>
table, th , td  {
  border: 1px solid grey;
  border-collapse: collapse;
  padding: 5px;
}
table tr:nth-child(odd) {
  background-color: #f1f1f1;
}
table tr:nth-child(even) {
  background-color: #ffffff;
}
</style>
<script src= "http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>

<?php

if (isset($_GET['id'])) 
	{ $ID=(trim($_GET['id'])); }
else 
	{ $ID = ''; }
$data_url = "editable.php?id=".$ID;
$update_url = "update.php?id=".$ID;
$np_url = "new_person.php?id=".$ID;


?>

<body>
 
<div ng-app="myApp" ng-controller="customersCtrl">

<form method="GET" action=<?php echo $update_url; ?>>
<label for="query">Organization Name:</label>
    <input type="text" class="form-control" name="O_Name" value="{{names.O_Name}}"></br>
    <label for="query">Location:</label>
<input type="text" class="form-control" name="Loc" value="{{names.O_Name}}"></br>
    <label for="query">Status:</label>
<input type="text" class="form-control" name="Stat" value="{{names.O_Name}}"></br>
</br></br>
<div ng-repeat "x in names">
<label for="query">Name:</label>
<input type="text" class="form-control" name="name" value="{{ x.Name }}">
<label for="query">Email:</label>
<input type="text" class="form-control" name="email" value="{{ x.Email }}">
<label for="query">Phone:</label>
<input type="text" class="form-control" name="phone" value="{{ x.Phone }}">
<label for="query">Assign Admin:</label>
<input type="text" class="form-control" name="admin" {{x.Admin ? checked : unchecked}}>
<label for="query">Assign Manager:</label>
<input type="text" class="form-control" name="Manager" {{x.Manager ? checked : unchecked}}>
<label for="query">Assign Contact:</label>
<input type="text" class="form-control" name="Contact" {{x.Contact ? checked : unchecked}}>
</div>
</form>
<form method="GET" action=<?php echo $np_url; ?>>
<label for="query">Name:</label>
<input type="text" class="form-control" name="name">
<label for="query">Email:</label>
<input type="text" class="form-control" name="email">
<label for="query">Phone:</label>
<input type="text" class="form-control" name="phone">
<label for="query">Assign Admin:</label>
<input type="text" class="form-control" name="admin" >
<label for="query">Assign Manager:</label>
<input type="text" class="form-control" name="Manager">
<label for="query">Assign Contact:</label>
<input type="text" class="form-control" name="Contact">

</form>

</div>

<script>
var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http) {
   $http.get(<?php echo $data_url; ?>)
   .success(function (response) {$scope.names = response.records;});
});
</script>