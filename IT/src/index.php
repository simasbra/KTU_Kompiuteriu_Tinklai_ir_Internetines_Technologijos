<?php
$server = "localhost";
$db = "IT";
$user = "stud";
$password = "stud";
$table = "Straipsnis";
$connection = mysqli_connect($server, $user, $password, $db);

if (!$connection) {
	die("Php is too stoopid to login to MySQL. Error:" . mysqli_error($connection));
}
?>

<!DOCTYPE html>

<html>

<?php include "headGimmeHead.php"; ?>

<script>
	function navigateToStraipsnis(id) {
		window.location.href = "article.php?id=" + id;
	}
</script>

<body>
	<?php include "navbar.php"; ?>

	<div>
		<center>
			<h1>Asmeninio/profesinio augimo konsultavimo internetu svetainė</h1>
			<h3>Simas Bradaitis</h3>
		</center>
	</div>

	<?php
	$sql =  "SELECT * FROM $table";

	if (!$result = $connection->query($sql)) {
		die("phP is too stoOopid to read the table. Error: " . $connection->error);
	}

	echo "<br/>";
	echo "<table style='margin: 0px auto;' id='straipsniai'>";
	echo "
		<tr>
		<th>Pavadinimas</th>
		<th>Tema</th>
		<th>Autorius</th>
		<th>Sukurimo data</th>
		</tr>
		";
	while ($row = $result->fetch_assoc()) {
		echo "
		<tr>
		<tr onclick='navigateToStraipsnis(" . $row['id'] . ")'>
		<td>" . $row['pavadinimas'] . "</td>
		<td>" . $row['tema'] . "</td>
		<td>" . $row['tema'] . "</td>
		<td>" . $row['sukurimo_data'] . "</td>
		</tr>
		";
	}
	?>
</body>

</html>

<?php $connection->close(); ?>
