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
	sleep(3);
	header("Location: index.php");
	exit();
}

$server = "localhost";
$db = "IT";
$user = "stud";
$password = "stud";
$connection = mysqli_connect($server, $user, $password, $db);

if (!$connection) {
	die("Failed to connect to MySQL. Error: " . mysqli_error($connection));
}

$title = $blocks = $message = "";
$topics = [];

// Read topics
$topic_sql = "SELECT id, pavadinimas FROM Tema";
$topic_result = $connection->query($topic_sql);

if ($topic_result && $topic_result->num_rows > 0) {
	while ($row = $topic_result->fetch_assoc()) {
		$topics[] = $row;
	}
} else {
	$message = "Temų nėra arba įvyko klaida gaunant temų sąrašą.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
	$title = trim($_POST['pavadinimas']);
	$topic_id = intval($_POST['tema']);
	$blocks = $_POST['blokai']; // Array with block data
	$user_id = $_SESSION['user_id'];
	$creation_date = date('Y-m-d H:i:s');

	if (empty($title) || empty($topic_id) || empty($blocks)) {
		$message = "Visi laukeliai yra privalomi!";
	} else {
		// Start transaction
		mysqli_begin_transaction($connection);

		try {
			// Insert the article
			$article_sql = "INSERT INTO Straipsnis (pavadinimas, sukurimo_data, vartotojas_id, tema_id) VALUES (?, ?, ?, ?)";
			$article_stmt = $connection->prepare($article_sql);
			$article_stmt->bind_param("ssii", $title, $creation_date, $user_id, $topic_id);
			$article_stmt->execute();
			$article_id = $connection->insert_id;

			// Insert the blocks
			foreach ($blocks as $block) {
				$text = trim($block['tekstas']);
				$image_id = null;

				// If an image is provided, insert it into Paveikslelis table
				if (!empty($block['paveikslelis_url']) && !empty($block['paveikslelis_pavadinimas']) && !empty($block['paveikslelis_pozicija'])) {
					$image_sql = "INSERT INTO Paveikslelis (pavadinimas, url, pozicija) VALUES (?, ?, ?)";
					$image_stmt = $connection->prepare($image_sql);
					$image_stmt->bind_param("sss", $block['paveikslelis_pavadinimas'], $block['paveikslelis_url'], $block['paveikslelis_pozicija']);
					$image_stmt->execute();
					// Get the id of the created image
					$image_id = $connection->insert_id;
					$image_stmt->close();
				}

				// Insert the block
				$block_sql = "INSERT INTO Straipsnis_Blokas (tekstas, straipsnis_id, paveikslelis_id) VALUES (?, ?, ?)";
				$block_stmt = $connection->prepare($block_sql);
				$block_stmt->bind_param("sii", $text, $article_id, $image_id);
				$block_stmt->execute();
				$block_stmt->close();
			}

			// Commit transaction
			mysqli_commit($connection);
			$message = "Straipsnis ir jo blokai sėkmingai sukurti!";
		} catch (Exception $e) {
			// Rollback transaction on error
			mysqli_roll_back($connection);
			$message = "Įvyko klaida: " . $e->getMessage();
		}

		$article_stmt->close();
	}
}

$connection->close();
?>

<!DOCTYPE html>

<html>

	<?php include "headGimmeHead.php"; ?>

	<body>
		<script>
		let blockCounter = 1;

		function addBlock() {
			const container = document.getElementById('blocks-container');
			const newBlock = document.createElement('div');
			newBlock.className = 'block';
			newBlock.innerHTML = `
				<label for="block-tekstas-${blockCounter}">Tekstas:</label><br>
				<textarea id="block-tekstas-${blockCounter}" name="blokai[${blockCounter}][tekstas]" rows="4" required></textarea><br><br>

				<h4>Paveikslėlis (pasirinktinai):</h4>
				<label for="block-paveikslelis-pavadinimas-${blockCounter}">Pavadinimas:</label><br>
				<input type="text" id="block-paveikslelis-pavadinimas-${blockCounter}" name="blokai[${blockCounter}][paveikslelis_pavadinimas]"><br><br>

				<label for="block-paveikslelis-url-${blockCounter}">URL:</label><br>
				<input type="text" id="block-paveikslelis-url-${blockCounter}" name="blokai[${blockCounter}][paveikslelis_url]"><br><br>

				<label for="block-paveikslelis-pozicija-${blockCounter}">Pozicija:</label><br>
				<select id="block-paveikslelis-pozicija-${blockCounter}" name="blokai[${blockCounter}][paveikslelis_pozicija]">
					<option value="top">Viršus</option>
					<option value="bottom">Apačia</option>
					<option value="left">Kairė</option>
					<option value="right">Dešinė</option>
				</select><br><br>
			`;
			container.appendChild(newBlock);
			blockCounter++;
		}
		</script>

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
				<select id="tema" name="tema" required>
					<option value="">Pasirinkite temą</option>
					<?php foreach ($topics as $topic): ?>
					<option value="<?php echo htmlspecialchars($topic['id']); ?>">
						<?php echo htmlspecialchars($topic['pavadinimas']); ?>
					</option>
					<?php endforeach; ?>
				</select><br><br>

				<h3>Blokai:</h3>
				<div id="blocks-container">
					<div class="block">
						<label for="block-tekstas-1">Tekstas:</label><br>
						<textarea id="block-tekstas-1" name="blokai[0][tekstas]" rows="4" required></textarea><br><br>

						<h4>Paveikslėlis (pasirinktinai):</h4>
						<label for="block-paveikslelis-pavadinimas-1">Pavadinimas:</label><br>
						<input type="text" id="block-paveikslelis-pavadinimas-1" name="blokai[0][paveikslelis_pavadinimas]"><br><br>

						<label for="block-paveikslelis-url-1">URL:</label><br>
						<input type="text" id="block-paveikslelis-url-1" name="blokai[0][paveikslelis_url]"><br><br>

						<label for="block-paveikslelis-pozicija-1">Pozicija:</label><br>
						<select id="block-paveikslelis-pozicija-1" name="blokai[0][paveikslelis_pozicija]">
							<option value="top">Top</option>
							<option value="bottom">Bottom</option>
							<option value="left">Left</option>
							<option value="right">Right</option>
						</select><br><br>
					</div>
				</div>

				<button type="button" onclick="addBlock()">Pridėti bloką</button><br><br>
				<input type="submit" value="Pateikti straipsnį">
			</form>

			<div>
				<a href="index.php">Grįžti į pradžią</a>
			</div>
		</div>
	</body>

</html>
