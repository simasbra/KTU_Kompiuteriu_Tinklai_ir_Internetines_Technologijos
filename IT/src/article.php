<?php
$server = "localhost";
$db = "IT";
$user = "stud";
$password = "stud";
$connection = mysqli_connect($server, $user, $password, $db);

if (!$connection) {
	die("Failed to connect to MySQL. Error: " . mysqli_error($connection));
}

$article_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "
		SELECT 
			Straipsnis.pavadinimas,
			Straipsnis.sukurimo_data,
			Tema.pavadinimas as tema,
			Vartotojas.vardas,
			Vartotojas.pavarde
		FROM Straipsnis
		JOIN Vartotojas ON Straipsnis.vartotojas_id = Vartotojas.id
		JOIN Tema ON Straipsnis.tema_id = Tema.id
		WHERE Straipsnis.id = ?
	";

$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $article_id);
$stmt->execute();
$result = $stmt->get_result();
$article = $result->fetch_assoc();

if (!$article) {
	echo "Straipsnis nerastas.";
	exit;
}

$blocks_sql = "
	SELECT 
		Straipsnis_Blokas.tekstas,
		Paveikslelis.url,
		Paveikslelis.pozicija
		Paveikslelis.pavadinimas
	FROM Straipsnis_Blokas
	LEFT JOIN Paveikslelis ON Straipsnis_Blokas.paveikslelis_id = Paveikslelis.id
	WHERE Straipsnis_Blokas.straipsnis_id = ?
	ORDER BY Straipsnis_Blokas.id ASC
";

$blocks_stmt = $connection->prepare($blocks_sql);
$blocks_stmt->bind_param("i", $article_id);
$blocks_stmt->execute();
$blocks_result = $blocks_stmt->get_result();

$blocks = [];
while ($row = $blocks_result->fetch_assoc()) {
	$blocks[] = $row;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rating']) && isset($_SESSION['user_id'])) {
	$rating = intval($_POST['rating']);
	$user_id = $_SESSION['user_id'];

	if ($rating >= 1 && $rating <= 10) {
		$rating_sql = "INSERT INTO Vertinimas (vertinimas, vartotojas_id, straipsnis_id) VALUES (?, ?, ?)";
		$rating_stmt = $connection->prepare($rating_sql);
		$rating_stmt->bind_param("iii", $rating, $user_id, $article_id);

		if ($rating_stmt->execute()) {
			$rating_message = "Jūsų įvertinimas sėkmingai pateiktas!";
		} else {
			$rating_message = "Klaida pateikiant įvertinimą: " . $connection->error;
		}

		$rating_stmt->close();
	} else {
		$rating_message = "Įvertinimas turi būti tarp 1 ir 10.";
	}
}

// Get all ratings for the article
$ratings_sql = "SELECT vertinimas FROM Vertinimas WHERE straipsnis_id = ?";
$ratings_stmt = $connection->prepare($ratings_sql);
$ratings_stmt->bind_param("i", $article_id);
$ratings_stmt->execute();
$ratings_result = $ratings_stmt->get_result();

$ratings = [];
while ($row = $ratings_result->fetch_assoc()) {
	$ratings[] = $row['vertinimas'];
}

$ratings_stmt->close();

if (count($ratings) > 0) {
	$avg_rating = array_sum($ratings) / count($ratings);
	$avg_rating = round($avg_rating, 1);
} else {
	$avg_rating = "Nėra įvertinimų";
}

$blocks_stmt->close();
$stmt->close();
$connection->close();
?>

<!DOCTYPE html>

<html>

<?php include "headGimmeHead.php"; ?>

<body>
	<?php include 'navbar.php'; ?>

	<div>
		<center>
			<h1>
				<?php echo htmlspecialchars($article['pavadinimas']); ?>
			</h1>
			<h3>Tema: &nbsp;
				<?php echo htmlspecialchars($article['tema']); ?>
			</h3>
			<p>Autorius: &nbsp;
				<?php echo htmlspecialchars($article['vardas'] . ' ' . $article['pavarde']); ?>
			</p>
			<p>Sukurimo data: &nbsp;
				<?php echo htmlspecialchars($article['sukurimo_data']); ?>
			</p>
		</center>
	</div>

	<div style="padding: 20px;">
		<?php foreach ($blocks as $block): ?>
			<div style="margin-bottom: 20px;">
				<?php if (!empty($block['url'])): ?>
					<?php if ($block['pozicija'] === 'top'): ?>
						<div class="image-top">
						<img
							src="<?php echo htmlspecialchars($block['url']); ?>"
							alt="<?php echo htmlspecialchars($block['pavadinimas']); ?>"
							style="max-width: 300px; max-height: 300px;">
						</div>
					<?php elseif ($block['pozicija'] === 'bottom'): ?>
						<div class="image-bottom">
						<img
							src="<?php echo htmlspecialchars($block['url']); ?>"
							alt="<?php echo htmlspecialchars($block['pavadinimas']); ?>"
							style="max-width: 300px; max-height: 300px;">
						</div>
					<?php elseif ($block['pozicija'] === 'left'): ?>
						<div class="image-left" style="float: left; margin-right: 10px;">
						<img
							src="<?php echo htmlspecialchars($block['url']); ?>"
							alt="<?php echo htmlspecialchars($block['pavadinimas']); ?>"
							style="max-width: 300px; max-height: 300px;">
						</div>
					<?php elseif ($block['pozicija'] === 'right'): ?>
						<div class="image-right" style="float: right; margin-left: 10px;">
						<img
							src="<?php echo htmlspecialchars($block['url']); ?>"
							alt="<?php echo htmlspecialchars($block['pavadinimas']); ?>"
							style="max-width: 300px; max-height: 300px;">
						</div>
					<?php endif; ?>
				<?php endif; ?>
				<p>
					<?php echo nl2br(htmlspecialchars($block['tekstas'])); ?>
				</p>
				<div style="clear: both;"></div>
			</div>
		<?php endforeach; ?>
	</div>

	<div class="rating-container" style="padding: 20px;">
		<h3>Įvertinti straipsnį</h3>
			<p>Vidutinis įvertinimas:
				<?php echo $avg_rating !== 0 ? round($avg_rating, 2) : "Nėra įvertinimų"; ?>
			</p>

		<?php if (!empty($rating_message)): ?>
			<p>
				<?php echo htmlspecialchars($rating_message); ?>
			</p>
		<?php endif; ?>

		<?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'Vartotojas'): ?>
			<form method="post" action="">
				<label for="rating">Pasirinkite įvertinimą (1-10):</label>
				<select name="rating" id="rating" required>
					<?php for ($i = 10; $i >= 1; $i--): ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php endfor; ?>
				</select>
				<input type="submit" value="Pateikti įvertinimą">
			</form>
		<?php endif; ?>
	</div>
</body>

</html>
