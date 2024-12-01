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
	die("Failed to connect to MySQL: " . mysqli_error($connection));
}

$contacts = [];

$sql = "
	SELECT
		k.id,
		k.telefonas,
		k.epastas,
		k.aprasymas,
		t.pavadinimas AS tema_pavadinimas, 
		v.vardas, v.pavarde 
	FROM Kontaktas k
	JOIN Tema t ON k.tema_id = t.id
	JOIN Vartotojas v ON k.vartotojas_id = v.id
";
$result = $connection->query($sql);

if ($result && $result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$contacts[] = $row;
	}
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="lt">

<?php include "headGimmeHead.php"; ?>

<body>
	<?php include 'navbar.php'; ?>

	<div style="margin: 0 auto; max-width: 800px; padding: 20px;">
		<h1>Kontaktų sąrašas</h1>

		<?php if (!empty($contacts)): ?>
			<table style='margin: 0px auto;' id='straipsniai'>
				<tr>
					<th>Telefonas</th>
					<th>El. paštas</th>
					<th>Aprašymas</th>
					<th>Tema</th>
					<th>Asmuo</th>
				</tr>
				<?php foreach ($contacts as $contact): ?>
					<tr>
						<td><?php echo htmlspecialchars($contact['telefonas']); ?></td>
						<td><?php echo htmlspecialchars($contact['epastas']); ?></td>
						<td><?php echo htmlspecialchars($contact['aprasymas']); ?></td>
						<td><?php echo htmlspecialchars($contact['tema_pavadinimas']); ?></td>
						<td><?php echo htmlspecialchars($contact['vardas'] . ' ' . $contact['pavarde']); ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		<?php else: ?>
			<center>
				<p>Kontaktų nėra.</p>
			</center>
		<?php endif; ?>
	</div>
</body>

</html>
