<?php
// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
	header("Location: index.php");
	exit();
}

$server = "localhost";
$db = "IT";
$user = "stud";
$password = "stud";
$dbc = mysqli_connect($server, $user, $password, $db);

if (!$dbc) {
	die("Failed to connect to MySQL. Error: " . mysqli_error($dbc));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = "SELECT * FROM Vartotojas WHERE prisijungimo_vardas = ?";
	$stmt = $dbc->prepare($query);
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows == 1) {
		$user = $result->fetch_assoc();
		if (password_verify($password, $user['slaptazodis'])) {
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['username'] = $user['prisijungimo_vardas'];
			$_SESSION['user_name'] = $user['vardas'] . ' ' . $user['pavarde'];
			$_SESSION['message'] = "Sėkmingai prisijungta!";
			header("Location: index.php");
			exit();
		} else {
			$_SESSION['message'] = "Neteisingas slaptažodis.";
		}
	} else {
		$_SESSION['message'] = "Neteisingas vartotojo vardas.";
	}

	$stmt->close();
}

$dbc->close();
?>

<!DOCTYPE html>
<html lang="lt">

<head>
	<meta charset="UTF-8">
	<title>Prisijungti</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include "navbar.php"; ?>

	<h2>Prisijungti</h2>
	<?php
	if (isset($_SESSION['message'])) {
		echo "<p>" . $_SESSION['message'] . "</p>";
		unset($_SESSION['message']);
	}
	?>
	<form method="POST" action="login.php">
		<label for="username">Vartotojo vardas:</label>
		<input type="text" name="username" required><br><br>
		<label for="password">Slaptažodis:</label>
		<input type="password" name="password" required><br><br>
		<input type="submit" value="Prisijungti">
	</form>
	<p>Dar neturite paskyros? <a href="register.php">Registruotis</a></p>
</body>

</html>
l>
