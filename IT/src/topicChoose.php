<?php
session_start();

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if (!isset($_SESSION['user_id'])) {
	echo "
		<div style='text-align: center; margin-top: 50px;'>
			<h2>Neturite prieigos</h2>
			<p>Šis puslapis yra prieinamas tik registruotiems naudotojams.</p>
		</div>
	";
	echo "<meta http-equiv='refresh' content='3;url=index.php'>";
	die();
}

$server = "localhost";
$db = "IT";
$user = "stud";
$password = "stud";
$connection = mysqli_connect($server, $user, $password, $db);

if (!$connection) {
	die("Failed to connect to MySQL. Error: " . mysqli_error($connection));
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM Vartotojas_Tema WHERE vartotojas_id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$selected_topics = [];
while ($row = $result->fetch_assoc()) {
	$selected_topics[] = $row['tema_id'];
}

$stmt->close();

$sql = "SELECT * FROM Tema";
$topics_result = $connection->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Delete user old topics
	$delete_sql = "DELETE FROM Vartotojas_Tema WHERE vartotojas_id = ?";
	$delete_stmt = $connection->prepare($delete_sql);
	$delete_stmt->bind_param("i", $user_id);
	$delete_stmt->execute();
	$delete_stmt->close();

	if (isset($_POST['topics'])) {
		$selected_topics = $_POST['topics'];
		// Save user topics
		foreach ($selected_topics as $topic_id) {
		$insert_sql = "INSERT INTO Vartotojas_Tema (vartotojas_id, tema_id) VALUES (?, ?)";
		$insert_stmt = $connection->prepare($insert_sql);
		$insert_stmt->bind_param("ii", $user_id, $topic_id);
		$insert_stmt->execute();
		$insert_stmt->close();
		}

		$message = "Temos buvo sėkmingai pasirinktos.";
	}
}

$connection->close();
?>

<!DOCTYPE html>

<html lang="lt">
	
<?php include "headGimmeHead.php"; ?>

<body>
	<?php include 'navbar.php'; ?>

	<div style="margin: 0 auto; max-width: 800px; padding: 20px;">
		<div class="form-container">
			<h1>Pasirinkite temas</h1>

			<?php if (isset($message)): ?>
				<p><?php echo htmlspecialchars($message); ?></p>
			<?php endif; ?>

			<form method="POST" action="topicChoose.php">
				<h3>Pasirinkite temas, kurios Jus domina:</h3>

				<?php if ($topics_result->num_rows > 0): ?>
					<?php while ($topic = $topics_result->fetch_assoc()): ?>
						<label>
						<input type="checkbox" name="topics[]" value="<?php echo $topic['id']; ?>" 
						<?php echo in_array($topic['id'], $selected_topics) ? 'checked' : ''; ?>>
						<?php echo htmlspecialchars($topic['pavadinimas']); ?>
						</label><br>
					<?php endwhile; ?>
				<?php else: ?>
					<p>Šiuo metu nėra jokių temų.</p>
				<?php endif; ?>

				<input class="submit-btn" type="submit" value="Išsaugoti pasirinkimus">
			</form>
		</div>
	</div>

</body>
</html>
