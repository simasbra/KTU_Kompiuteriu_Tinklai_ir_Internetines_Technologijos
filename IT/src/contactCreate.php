<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Publisher') {
	echo "
		<div style='text-align: center; margin-top: 50px;'>
			<h2>Neturite prieigos</h2>
			<p>Šis puslapis yra prieinamas tik rašytojams.</p>
		</div>
	";
	header("Refresh: 3; URL=index.php");
	exit();
}

$server = "localhost";
$db = "IT";
$user = "stud";
$password = "stud";
$connection = mysqli_connect($server, $user, $password, $db);

if (!$connection) {
	die("Failed to connect to MySQL: " . mysqli_error($connection));
}

$message = "";
$topics = [];

$topic_sql = "SELECT id, pavadinimas FROM Tema";
$topic_result = $connection->query($topic_sql);

if ($topic_result && $topic_result->num_rows > 0) {
	while ($row = $topic_result->fetch_assoc()) {
		$topics[] = $row;
	}
} else {
	$message = "Temų nėra arba įvyko klaida gaunant temų sąrašą.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$telefonas = trim($_POST['telefonas']);
	$epastas = trim($_POST['epastas']);
	$aprasymas = trim($_POST['aprasymas']);
	$tema_id = intval($_POST['tema']);
	$vartotojas_id = $_SESSION['user_id'];

	if (empty($tema_id) || (empty($telefonas) && empty($epastas))) {
		$message = "Reikalinga bent viena kontaktinė informacija ir tema!";
	} else {
		$insert_sql = "INSERT INTO Kontaktas (telefonas, epastas, aprasymas, vartotojas_id, tema_id)
			       VALUES (?, ?, ?, ?, ?)";
		$stmt = $connection->prepare($insert_sql);
		$stmt->bind_param("sssii", $telefonas, $epastas, $aprasymas, $vartotojas_id, $tema_id);

		if ($stmt->execute()) {
			$message = "Kontaktas sėkmingai sukurtas!";
		} else {
			$message = "Klaida įrašant kontaktą: " . $connection->error;
		}

		$stmt->close();
	}
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="lt">

<?php include "headGimmeHead.php"; ?>

<body>
    <?php include 'navbar.php'; ?>

    <div style="padding: 20px;">
        <h1>Pridėti naują kontaktą</h1>

        <?php if (!empty($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form method="post" action="kontaktaiCreate.php">
            <label for="telefonas">Telefonas:</label><br>
            <input type="text" id="telefonas" name="telefonas"><br><br>

            <label for="epastas">El. paštas:</label><br>
            <input type="email" id="epastas" name="epastas"><br><br>

            <label for="aprasymas">Aprašymas:</label><br>
            <textarea id="aprasymas" name="aprasymas" rows="4"></textarea><br><br>

            <label for="tema">Tema:</label><br>
            <select id="tema" name="tema" required>
                <option value="">Pasirinkite temą</option>
                <?php foreach ($topics as $topic): ?>
                <option value="<?php echo htmlspecialchars($topic['id']); ?>">
                    <?php echo htmlspecialchars($topic['pavadinimas']); ?>
                </option>
                <?php endforeach; ?>
            </select><br><br>

            <input class="submit-btn" type="submit" value="Pridėti kontaktą">
        </form>
    </div>
</body>

</html>
