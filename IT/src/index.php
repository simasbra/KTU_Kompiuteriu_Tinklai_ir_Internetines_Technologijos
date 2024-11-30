<?php
$server = "localhost";
$db = "IT";
$user = "stud";
$password = "stud";
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
	$sql = "
		SELECT
			Straipsnis.id,
			Straipsnis.pavadinimas,
			Straipsnis.sukurimo_data,
			Tema.pavadinimas as tema,
			CONCAT(Vartotojas.vardas, ' ', Vartotojas.pavarde) as autorius
		FROM Straipsnis
		JOIN Vartotojas ON Straipsnis.vartotojas_id = Vartotojas.id
		JOIN Tema ON Straipsnis.tema_id = Tema.id
	";

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
				<td>" . $row['autorius'] . "</td>
				<td>" . $row['sukurimo_data'] . "</td>
			</tr>
		";
	}
	?>
</body>

</html>

<?php $connection->close(); ?>
