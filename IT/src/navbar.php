<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

$server = "localhost";
$user = "stud";
$password = "stud";
$db = "IT";

$connection = new mysqli($server, $user, $password, $db);

if ($connection->connect_error) {
	die("Connection failed: " . $connection->connect_error);
}

$is_logged_in = isset($_SESSION['user_id']);
$is_vadybininkas = false;

if ($is_logged_in) {
	$user_id = $_SESSION['user_id'];
	$sql = "SELECT paskyros_tipas_id FROM Vartotojas WHERE id = ?";
	$stmt = $connection->prepare($sql);
	$stmt->bind_param("i", $user_id);
	$stmt->execute();
	$stmt->bind_result($paskyros_tipas_id);
	$stmt->fetch();
	$stmt->close();

	$is_vadybininkas = ($paskyros_tipas_id == 2);
}

$connection->close();
?>

<div class="navbar">
	<ul>
		<li>
			<a href="index.php">Pradinis puslapis</a>
		</li>
		<li>
			<a href="task.php">Užduotis</a>
		</li>

		<?php if ($is_logged_in): ?>
			<li>
				<a href="articlesMine.php">Mano straipsniai</a>
			</li>
			<?php if ($is_vadybininkas): ?>
				<li>
					<a href="articleCreate.php">Kurti straipsni</a>
				</li>
			<?php endif; ?>
			<li>
				<a href="">Statistika</a>
			</li>
			<li class="dropdown">
				<a href="#" class="dropbtn"><?php echo htmlspecialchars($_SESSION['user_name']); ?></a>
				<div class="dropdown-content">
					<a href="logout.php">Atsijungti</a>
				</div>
			</li>
		<?php else: ?>
			<li>
				<a href="login.php">Prisijungti</a>
			</li>
		<?php endif; ?>
	</ul>
</div>
