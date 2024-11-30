<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if (isset($_SESSION['user_id'])) {
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$query ="SELECT
			V.id,
			V.prisijungimo_vardas,
			V.slaptazodis,
			V.vardas,
			V.pavarde,
			P.pavadinimas AS role
		FROM Vartotojas V
		JOIN Paskyros_tipas P ON V.paskyros_tipas_id = P.id
		WHERE V.prisijungimo_vardas = ?";
	$stmt = $connection->prepare($query);
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows == 1) {
		$user = $result->fetch_assoc();
		if (password_verify($password, $user['slaptazodis'])) {
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['username'] = $user['prisijungimo_vardas'];
			$_SESSION['user_name_surname'] = $user['vardas'] . ' ' . $user['pavarde'];
			$_SESSION['user_role'] = $user['role'];
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

$connection->close();
?>

<!DOCTYPE html>
<html lang="lt">

<?php include "headGimmeHead.php"; ?>

<body>
	<?php include "navbar.php"; ?>

	<div class="form-container">
		<h2>Prisijungti</h2>
		<?php
		if (isset($_SESSION['message'])) {
			echo "<div class='message-box'>" . $_SESSION['message'] . "</div>";
			unset($_SESSION['message']);
		}
		?>
		<form method="POST" action="login.php">
			<div class="form-group">
				<label for="username">Vartotojo vardas:</label>
				<input type="text" name="username" id="username" required>
			</div>
			<div class="form-group">
				<label for="password">Slaptažodis:</label>
				<input type="password" name="password" id="password" required>
			</div>
			<input type="submit" value="Prisijungti" class="submit-btn">
		</form>
		<p>
			Dar neturite paskyros?
			<a href="register.php">Registruotis</a>
		</p>
	</div>
</body>

</html>
