<?php
$result = array();
if (isset($_POST)) {
	require_once('config.php');
	$dbc = @mysqli_connect(hostname, username, password, database);
	if (!$dbc) {
		$result = array('error' => "Cannot connect: ".mysqli_error($dbc));
	}
	else {
		$query = "INSERT INTO json (created, ip, name, email, message) VALUES
			(NOW(), '".$_SERVER['REMOTE_ADDR']."', '".htmlspecialchars($_POST['name'])."', '".htmlspecialchars($_POST['message']);
		mysqli_close($dbc);
		$result = array('success' => 'success');
	}
}
echo json_encode($result);
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");  
?>
