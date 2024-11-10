<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

$server = "localhost";
$db = "IT";
$user = "stud";
$password = "stud";
$table = "Straipsnis";
$connection = mysqli_connect($server, $user, $password, $db);

if (!$connection) {
	die("Failed to connect to MySQL. Error: " . mysqli_error($connection));
}

$title = $topic = $content = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
	$title = trim($_POST['pavadinimas']);
	$topic = trim($_POST['tema']);
	$content = trim($_POST['tekstas']);
	$user_id = $_SESSION['user_id'];
	$creation_date = date('Y-m-d H:i:s');

	if (empty($title) || empty($topic) || empty($content)) {
		$message = "Visi laukeliai yra privalomi!";
	} else {
		$sql = "INSERT INTO $table (pavadinimas, tema, tekstas, sukurimo_data, vartotojas_id) VALUES (?, ?, ?, ?, ?)";
		$stmt = $connection->prepare($sql);
		$stmt->bind_param("ssssi", $title, $topic, $content, $creation_date, $user_id);

		if ($stmt->execute()) {
			$message = "Straipsnis sėkmingai sukurtas!";
		} else {
			$message = "Įvyko klaida kuriant straipsnį: " . $connection->error;
		}

		$stmt->close();
	}
}

$connection->close();
?>

<!DOCTYPE html>

<html>

<?php include "headGimmeHead.php"; ?>

<body>
	<?php include 'navbar.php'; ?>

	<div style="padding: 20px;">
		<h1>Kurti naują straipsnį</h1>

		<?php if (!empty($message)): ?>
			<p><?php echo htmlspecialchars($message); ?></p>
		<?php endif; ?>

		<form method="post" action="articleCreate.php">
			<label for="pavadinimas">Pavadinimas:</label><br>
			<input type="text" id="pavadinimas" name="pavadinimas" value="<?php echo htmlspecialchars($title); ?>" required><br><br>

			<label for="tema">Tema:</label><br>
			<input type="text" id="tema" name="tema" value="<?php echo htmlspecialchars($topic); ?>" required><br><br>

			<label for="tekstas">Turinys:</label><br>
			<textarea id="tekstas" name="tekstas" rows="10" required><?php echo htmlspecialchars($content); ?></textarea><br><br>

			<input type="submit" value="Pateikti straipsnį">
		</form>

		<div>
			<a href="index.php">Grįžti į pradžią</a>
		</div>
	</div>
</body>

</html>
