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
	sleep(3);
	header("Location: index.php");
	exit();
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

$title = $topic = $content = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
	$title = trim($_POST['pavadinimas']);
	$user_id = $_SESSION['user_id'];

	if (empty($title)) {
		$message = "Visi laukeliai yra privalomi!";
	} else {
		$sql = "INSERT INTO $table (pavadinimas, vartotojas_id) VALUES (?, ?)";
		$stmt = $connection->prepare($sql);
		$stmt->bind_param("si", $title, $user_id);

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

			<input type="submit" value="Pateikti temą">
		</form>

		<div>
			<a href="index.php">Grįžti į pradžią</a>
		</div>
	</div>
</body>

</html>
