<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Publisher') {
	echo "
		<div style='text-align: center; margin-top: 50px;'>
			<h2>Neturite prieigos</h2>
			<p>Šis puslapis yra prieinamas tik raštojams.</p>
		</div>
	";
	sleep(3);
	header("Location: index.php");
	exit();
}

$user_id = $_SESSION['user_id'];
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

	<?php
	$sql = "
		SELECT
			Straipsnis.id,
			Straipsnis.pavadinimas,
			Straipsnis.sukurimo_data,
			Straipsnis.vartotojas_id,
			Tema.pavadinimas as tema,
			CONCAT(Vartotojas.vardas, ' ', Vartotojas.pavarde) as autorius
		FROM Straipsnis
		JOIN Vartotojas ON Straipsnis.vartotojas_id = Vartotojas.id
		JOIN Tema ON Straipsnis.tema_id = Tema.id
		WHERE vartotojas_id='$user_id'
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
