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
	}
?>

<html>
	<head>
		<title>Straipsnis - <?php echo htmlspecialchars($article['pavadinimas']); ?></title>
		<meta charset="UTF-8">
	</head>

	<body>
		<div>
			<ul>
				<li><a href="index.php">Pradinis puslapis</a></li>
				<li><a href="uzduotis.html">Užduotis</a></li>
				<li><a href="">Mano straipsniai</a></li>
				<li><a href="">Kurti straipsni</a></li>
				<li><a href="">Statistika</a></li>
				<li><a href="">Prisijungti</a></li>
			</ul>
		</div>

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

		<div>
			<a href="index.php">Grįžti į pradžią</a>
		</div>
	</body>
</html>

<?php
	$stmt->close();
	$dbc->close();
?>
>
