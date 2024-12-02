<?ph
	<?php
	if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Administrator') {
	echo "
		<div style='text-align: center; margin-top: 50px;'>
			<h2>Neturite prieigos</h2>
			<p>Šis puslapis yra prieinamas tik administratoriams.</p>
		</div>
	";
	echo "<meta http-equiv='refresh' content='3;url=index.php'>";
	die();
}

$server = "localhost";
$db = "IT";
$user = "stud";
$password = "stud";
$table = "Tema";
$connection = mysqli_connect($server, $user, $password, $db);

if (!$connection) {
	die("Failed to connect to MySQL. Error: " . mysqli_error($connection));
}

$title = $message = "";

// Create new topic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
	$title = trim($_POST['pavadinimas']);
	$user_id = $_SESSION['user_id'];

	if (empty($title)) {
		$message = "Pavadinimas yra privalomas!";
	} else {
		$sql = "INSERT INTO $table (pavadinimas, vartotojas_id) VALUES (?, ?)";
		$stmt = $connection->prepare($sql);
		$stmt->bind_param("si", $title, $user_id);

		if ($stmt->execute()) {
			$message = "Tema sėkmingai sukurta!";
			$title = '';
		} else {
			$message = "Įvyko klaida kuriant temą: " . $connection->error;
		}

		$stmt->close();
	}
}

// Fetch all topics
$sql = "SELECT * FROM $table";
$topics_result = $connection->query($sql);

// Delete selected topci
if (isset($_GET['delete_id'])) {
	$delete_id = $_GET['delete_id'];
	$delete_sql = "DELETE FROM $table WHERE id = ?";
	$delete_stmt = $connection->prepare($delete_sql);
	$delete_stmt->bind_param("i", $delete_id);
	$delete_stmt->execute();
	$delete_stmt->close();
	header("Location: topicCreate.php");
	exit();
}

$connection->close();
?>

<!DOCTYPE html>

<html lang="lt">

<?php include "headGimmeHead.php"; ?>

<body>
	<?php include 'navbar.php'; ?>

	<div style="margin: 0 auto; max-width: 800px; padding: 20px;">
		<h1>Kurti naują temą</h1>

		<?php if (!empty($message)): ?>
		<p><?php echo htmlspecialchars($message); ?></p>
		<?php endif; ?>

		<form method="post" action="topicCreate.php">
			<label for="pavadinimas">Pavadinimas:</label><br>
			<input type="text" id="pavadinimas" name="pavadinimas" value="<?php echo htmlspecialchars($title); ?>" required><br><br>

			<input type="submit" value="Pateikti temą">
		</form>

		<h2>Visos temos</h2>
		<?php if ($topics_result->num_rows > 0): ?>
			<table border="1" cellpadding="10" style="width: 100%; background-color: #1b2a40; color: white;">
				<thead>
					<tr>
						<th>Pavadinimas</th>
						<th>Veiksmai</th>
					</tr>
				</thead>

				<tbody>
					<?php while ($row = $topics_result->fetch_assoc()): ?>
						<tr>
							<td><?php echo htmlspecialchars($row['pavadinimas']); ?></td>
							<td>
								<a class="submit-btn" href="topicCreate.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Ar tikrai norite ištrinti šią temą?')">Ištrinti</a>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>

		<?php else: ?>
			<p>Šiuo metu nėra jokių temų.</p>
		<?php endif; ?>
	</div>
</body>

</html>
