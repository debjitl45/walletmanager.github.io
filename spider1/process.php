<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

</body>
</html>









<?php
session_start();

$mysqli = new mysqli('localhost','root','','data') or die(mysqli_error($mysqli));

$name = '';
$budget = '';
$details ='';
$update = false;

if(isset($_POST['save'])){
	$name = $_POST['name'];
	$budget = $_POST['budget'];
	$details = $_POST['details'];
	$mysqli->query("INSERT INTO data(name, budget,details) VALUES('$name','$budget','$details')") or die($mysqli->error);

	$_SESSION['message']  = "Record has been saved!";
	$_SESSION['msg_type'] = "success";
	header("location: money.php");
}
if(isset($_GET['delete'])){
	$id = $_GET['delete'];
	$mysqli->query("DELETE FROM data WHERE id='$id'") or die($mysqli->error());

	$_SESSION['message']  = "Record has been deleted!";
	$_SESSION['msg_type'] = "danger";
	header("location: money.php");
}

if(isset($_GET['edit'])){
	$id = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * FROM data WHERE id='$id' ") or die($mysqli->error());
	if($result)
	{
		$row = $result->fetch_array();
		$name = $row['name'];
		$budget = $row['budget'];
		$details = $row['details'];
	}

}
header("location: money.php");

?>