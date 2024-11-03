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

	$article_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

	// Fetch article details
	$sql = "
		SELECT 
		Straipsnis.pavadinimas,
		Straipsnis.tema,
		Straipsnis.tekstas,
		Straipsnis.sukurimo_data,
		Vartotojas.vardas,
		Vartotojas.pavarde
		FROM Straipsnis
		JOIN Vartotojas ON Straipsnis.vartotojas_id = Vartotojas.id
		WHERE Straipsnis.id = ?
	";

	$stmt = $dbc->prepare($sql);
	$stmt->bind_param("i", $article_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$article = $result->fetch_assoc();

	if (!$article) {
		echo "Straipsnis nerastas.";
		exit;

	// Handle rating submission
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rating'])) {
			$rating = intval($_POST['rating']);
			$user_id = 1; // Assume a logged-in user with ID 1; replace with dynamic user ID as needed

		if ($rating >= 1 && $rating <= 10) {
			$rating_sql = "INSERT INTO Vertinimas (vertinimas, vartotojas_id, straipsnis_id) VALUES (?, ?, ?)";
			$rating_stmt = $dbc->prepare($rating_sql);
			$rating_stmt->bind_param("iii", $rating, $user_id, $article_id);

			if ($rating_stmt->execute()) {
				$rating_message = "Jūsų įvertinimas sėkmingai pateiktas!";
			} else {
				$rating_message = "Klaida pateikiant įvertinimą: " . $dbc->error;
			}

			$rating_stmt->close();
		} else {
			$rating_message = "Įvertinimas turi būti tarp 1 ir 10.";
		}
	}

	// Calculate the average rating for the article
	$avg_rating_sql = "SELECT AVG(vertinimas) AS avg_rating FROM Vertinimas WHERE straipsnis_id = ?";
	$avg_stmt = $dbc->prepare($avg_rating_sql);
	$avg_stmt->bind_param("i", $article_id);
	$avg_stmt->execute();
	$avg_result = $avg_stmt->get_result();
	$avg_rating = $avg_result->fetch_assoc()['avg_rating'] ?? "N/A";
	$avg_stmt->close();

	$stmt->close();
	$dbc->close();}
?>

<html>
	<head>
		<title>Straipsnis - <?php echo htmlspecialchars($article['pavadinimas']); ?></title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<?php include 'navbar.php'; ?>

		<div>
			<center>
				<h1><?php echo htmlspecialchars($article['pavadinimas']); ?></h1>
				<h3>Tema: <?php echo htmlspecialchars($article['tema']); ?></h3>
				<p>Autorius: <?php echo htmlspecialchars($article['vardas'] . ' ' . $article['pavarde']); ?></p>
				<p>Sukurimo data: <?php echo htmlspecialchars($article['sukurimo_data']); ?></p>
			</center>
		</div>

		<div style="padding: 20px;">
			<p><?php echo nl2br(htmlspecialchars($article['tekstas'])); ?></p>
		</div>

		<div style="padding: 20px;">
			<h3>Įvertinti straipsnį</h3>
			<p>Vidutinis įvertinimas: <?php echo $avg_rating !== "N/A" ? round($avg_rating, 1) : "Nėra įvertinimų"; ?></p>

			<?php if (!empty($rating_message)): ?>
			<p><?php echo htmlspecialchars($rating_message); ?></p>
			<?php endif; ?>

			<form method="post" action="">
				<label for="rating">Pasirinkite įvertinimą (1-10):</label>
				<select name="rating" id="rating" required>
					<?php for ($i = 1; $i <= 10; $i++): ?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php endfor; ?>
				</select>
				<input type="submit" value="Pateikti įvertinimą">
			</form>
		</div>

		<div>
			<a href="index.php">Grįžti į pradžią</a>
		</div>
	</body>
</html>
