<!DOCTYPE html>

<?php
	$server = "localhost";
	$db = "IT";
	$user = "stud";
	$password = "stud";
	$dbc = mysqli_connect($server, $user, $password, $db);

	if (!$dbc) {
	    die("Failed to connect to MySQL. Error: " . mysqli_error($dbc));
	}

	$title = $topic = $content = $message = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$title = trim($_POST['pavadinimas']);
		$topic = trim($_POST['tema']);
		$content = trim($_POST['tekstas']);
		$author_id = 1; // Assume a logged-in user with ID 1 (replace with dynamic user ID as needed)
		$creation_date = date('Y-m-d H:i:s');

		if (empty($title) || empty($topic) || empty($content)) {
			$message = "Visi laukeliai yra privalomi!";
		} else {
			$sql = "INSERT INTO Straipsnis (pavadinimas, tema, tekstas, sukurimo_data, vartotojas_id) VALUES (?, ?, ?, ?, ?)";
			$stmt = $dbc->prepare($sql);
			$stmt->bind_param("ssssi", $title, $topic, $content, $creation_date, $author_id);

			if ($stmt->execute()) {
				$message = "Straipsnis sėkmingai sukurtas!";
			} else {
				$message = "Įvyko klaida kuriant straipsnį: " . $dbc->error;
			}

			$stmt->close();
		}
	}

	$dbc->close();
?>

<html>
	<head>
		<title>Kurti straipsnį</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

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
