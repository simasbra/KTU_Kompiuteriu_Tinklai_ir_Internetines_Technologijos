<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
$server = "localhost";
$db = "IT";
$user = "stud";
$password = "stud";
$connection = mysqli_connect($server, $user, $password, $db);

if (!$connection) {
	die("Failed to connect to MySQL. Error: " . mysqli_error($connection));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$username = mysqli_real_escape_string($connection, $_POST['username']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);
	$name = mysqli_real_escape_string($connection, $_POST['name']);
	$surname = mysqli_real_escape_string($connection, $_POST['surname']);
	$password_hash = password_hash($password, PASSWORD_DEFAULT);
	$paskyros_tipas_id = intval($_POST['paskyros_tipas_id']);

	$query = "INSERT INTO Vartotojas (prisijungimo_vardas, slaptazodis, vardas, pavarde, paskyros_tipas_id) VALUES (?, ?, ?, ?, ?)";
	$stmt = $connection->prepare($query);
	$stmt->bind_param("ssssi", $username, $password_hash, $name, $surname, $paskyros_tipas_id);

	if ($stmt->execute()) {
		$_SESSION['message'] = "Registracija sėkminga. Dabar galite prisijungti.";
		header("Location: login.php");
		exit();
	} else {
		$_SESSION['message'] = "Klaida registruojant vartotoją: " . $connection->error;
	}

	$stmt->close();
}

$connection->close();
?>

<!DOCTYPE html>

<html lang="lt">

<?php include "headGimmeHead.php"; ?>

<body>
	<?php include "navbar.php"; ?>

	<h2>Registracija</h2>

	<?php
	if (isset($_SESSION['message'])) {
		echo "<p>" . $_SESSION['message'] . "</p>";
		unset($_SESSION['message']);
	}
	?>

	<form method="POST" action="register.php">
		<label for="username">Vartotojo vardas:</label>
		<input type="text" name="username" required><br><br>
		<label for="password">Slaptažodis:</label>
		<input type="password" name="password" required><br><br>
		<label for="name">Vardas:</label>
		<input type="text" name="name" required><br><br>
		<label for="surname">Pavardė:</label>
		<input type="text" name="surname" required><br><br>
		<label for="paskyros_tipas_id">Pasirinkite paskyros tipą:</label>
		<select name="paskyros_tipas_id" id="paskyros_tipas_id" required>
			<option value="1">Reader</option>
			<option value="2">Publisher</option>
			<option value="3">Administrator</option>
		</select><br><br>
		<input type="submit" value="Registruotis">
	</form>
</body>

</html>
