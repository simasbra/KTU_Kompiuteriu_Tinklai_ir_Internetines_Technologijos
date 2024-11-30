<?php
$server = "localhost";
$db = "IT";
$user = "stud";
$password = "stud";
$connection = mysqli_connect($server, $user, $password, $db);

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

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
	$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

	if ($user_id !== null) {

		$sql = "
			SELECT tema_id
			FROM Vartotojas_Tema
			WHERE vartotojas_id = ?
		";

		$stmt = $connection->prepare($sql);
		$stmt->bind_param("i", $user_id);
		$stmt->execute();
		$result = $stmt->get_result();

		$selected_topics = [];
		while ($row = $result->fetch_assoc()) {
		$selected_topics[] = $row['tema_id'];
		}

		$stmt->close();

		$selected_topics_str = implode(",", $selected_topics);
		$sql = "
			SELECT
				Straipsnis.id,
				Straipsnis.pavadinimas,
				Straipsnis.sukurimo_data,
				Tema.pavadinimas AS tema,
				CONCAT(Vartotojas.vardas, ' ', Vartotojas.pavarde) AS autorius
			FROM Straipsnis
			JOIN Vartotojas ON Straipsnis.vartotojas_id = Vartotojas.id
			JOIN Tema ON Straipsnis.tema_id = Tema.id
			WHERE Tema.id IN ($selected_topics_str)
			ORDER BY FIELD(Tema.id, $selected_topics_str)  -- Prioritize selected topics
		";

		$selected_topics_result = $connection->query($sql);

		if (!$selected_topics_result) {
			die("phP is too stoOopid to read the table. Error: " . $connection->error);
		}

		echo "<h2>Temos, kurios jus domina</h2>";
		echo "<table style='margin: 0px auto;' id='straipsniai'>";
		echo "
			<tr>
				<th>Pavadinimas</th>
				<th>Tema</th>
				<th>Autorius</th>
				<th>Sukurimo data</th>
			</tr>
		";
	}

	while ($row = $selected_topics_result->fetch_assoc()) {
		echo "
			<tr onclick='navigateToStraipsnis(" . $row['id'] . ")'>
				<td>" . $row['pavadinimas'] . "</td>
				<td>" . $row['tema'] . "</td>
				<td>" . $row['autorius'] . "</td>
				<td>" . $row['sukurimo_data'] . "</td>
			</tr>
		";
	}

	$sql_rest = "
		SELECT
			Straipsnis.id,
			Straipsnis.pavadinimas,
			Straipsnis.sukurimo_data,
			Tema.pavadinimas AS tema,
			CONCAT(Vartotojas.vardas, ' ', Vartotojas.pavarde) AS autorius
		FROM Straipsnis
		JOIN Vartotojas ON Straipsnis.vartotojas_id = Vartotojas.id
		JOIN Tema ON Straipsnis.tema_id = Tema.id
		WHERE Tema.id NOT IN ($selected_topics_str)
	";

	$rest_result = $connection->query($sql_rest);

	if (!$rest_result) {
		die("phP is too stoOopid to read the table. Error: " . $connection->error);
	}

	if ($user === null) {
		echo "<h2>Visos temos</h2>";
		echo "<table style='margin: 0px auto;' id='straipsniai'>";
		echo "
			<tr>
				<th>Pavadinimas</th>
				<th>Tema</th>
				<th>Autorius</th>
				<th>Sukurimo data</th>
			</tr>
		";
	}

	while ($row = $rest_result->fetch_assoc()) {
	echo "
		<tr onclick='navigateToStraipsnis(" . $row['id'] . ")'>
			<td>" . $row['pavadinimas'] . "</td>
			<td>" . $row['tema'] . "</td>
			<td>" . $row['autorius'] . "</td>
			<td>" . $row['sukurimo_data'] . "</td>
		</tr>
	";
	}

	echo "</table>";
	?>
</body>

</html>

<?php $connection->close(); ?>
