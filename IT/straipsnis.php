<?php
	$server = "localhost";
	$db = "IT";
	$user = "stud";
	$password = "stud";
	$table = "Straipsnis";
	$dbc = mysqli_connect($server,$user,$password, $db);
	if(!$dbc) {
		die ("Php is too stoopid to login to MySQL. Error:" .mysqli_error($dbc));
	}
?>
