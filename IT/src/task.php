<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if (!isset($_SESSION['user_id'])) {
	echo "
		<div style='text-align: center; margin-top: 50px;'>
			<h2>Neturite prieigos</h2>
			<p>Šis puslapis yra prieinamas tik registruotiems naudotojams.</p>
		</div>
	";
	echo "<meta http-equiv='refresh' content='3;url=login.php'>";
	die();
}

if (!$connection) {
	die("Php is too stoopid to login to MySQL. Error:" . mysqli_error($connection));
}
?>

<!DOCTYPE html>

<html>

<head>
	<title>Užduotis</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include "navbar.php"; ?>

	<div style="margin: 0 auto; max-width: 800px; padding: 20px;">
		<p><strong>Pagrindinės funkcijos:</strong></p>
		<p>Galimybė matyti turini susijusi su asmeninio/profesinio augimo,</p>
		<p>Balsuoti už labiausiai patikusius straipsnius,</p>
		<p>Galimybė įkelti temas į svetaine pagal temas.</p>
		<p>Kontaktai, kuriais galima susisiekti dėl paslaugų (forma su kontaktais)</p>
		<p><strong>Papildomos funkcijos:</strong></p>
		<p>Statistikos matymas grafikais (stulpeliai ir skrituliné diagrama), kurios 5 temos yra populiariausios</p>
	</div>
</body>

</html>
