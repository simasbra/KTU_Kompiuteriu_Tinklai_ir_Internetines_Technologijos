<?php
session_start();

$server = "localhost";
$db = "IT";
$user = "stud";
$password = "stud";
$dbc = mysqli_connect($server, $user, $password, $db);

if (!$dbc) {
	die("Failed to connect to MySQL. Error: " . mysqli_error($dbc));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$username = mysqli_real_escape_string($dbc, $_POST['username']);
	$password = mysqli_real_escape_string($dbc, $_POST['password']);
	$name = mysqli_real_escape_string($dbc, $_POST['name']);
	$surname = mysqli_real_escape_string($dbc, $_POST['surname']);
	$password_hash = password_hash($password, PASSWORD_DEFAULT); // Hash the password

	$query = "INSERT INTO Vartotojas (prisijungimo_vardas, slaptazodis, vardas, pavarde, paskyros_tipas_id) VALUES (?, ?, ?, ?, ?)";
	$stmt = $dbc->prepare($query);
	$paskyros_tipas_id = 1; // Assuming "Vartotojas" is the default type for normal users
	$stmt->bind_param("ssssi", $username, $password_hash, $name, $surname, $paskyros_tipas_id);

	if ($stmt->execute()) {
		$_SESSION['message'] = "Registracija sėkminga. Dabar galite prisijungti.";
		header("Location: login.php");
		exit();
	} else {
		$_SESSION['message'] = "Klaida registruojant vartotoją: " . $dbc->error;
	}

	$stmt->close();
}

$dbc->close();
?>

<!DOCTYPE html>
<html lang="lt">

<head>
	<meta charset="UTF-8">
	<title>Registracija</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

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
		<input type="submit" value="Registruotis">
	</form>
</body>

</html>
