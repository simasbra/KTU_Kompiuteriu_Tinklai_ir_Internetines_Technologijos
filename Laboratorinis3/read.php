<?php
$messages = array();
require_once('config-php');
$connection = (mysqli_connect(hostname, username, password, database));
if (!$connection) {
	$result = array ('error' => "Cannot connect: ".mysqli_error($connection));
	echo json_encode($result);
	exit ();
}
$query = "select * from json";
$result = (mysqli_query($connection, $query));
while ($row = mysqli_fetch_array($result)) {
	$messages []=$row;
}
mysqli_close($connection);
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
echo json_encode($messages);
?>
