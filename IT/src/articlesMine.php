<!DOCTYPE html>

<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$user_id = $_SESSION['user_id'];
	$server = "localhost";
	$db = "IT";
	$user = "stud";
	$password = "stud";
	$table = "Straipsnis";
	$dbc = mysqli_connect($server,$user,$password, $db);

	if(!$dbc) {
		die ("Php is too stoopid to login to MySQL. Error:" .mysqli_error($dbc));
	}
?>

<html>
	<?php include "headGimmeHead.php"; ?>

	<script>
		function navigateToStraipsnis(id) {
			window.location.href = "article.php?id=" + id;
		}
	</script>

	<body>
		<?php include "navbar.php"; ?>

		<?php
			$sql =  "SELECT * FROM $table WHERE vartotojas_id='$user_id'";

			if (!$result = $dbc->query($sql)) {
				die("phP is too stoOopid to read the table. Error: " . $dbc->error);
			}

			echo "<br/>";
			echo "<table style='margin: 0px auto;' id='straipsniai'>";
			echo "
				<tr>
					<th>Pavadinimas</th>
					<th>Tema</th>
					<th>Autorius</th>
					<th>Sukurimo data</th>
				</tr>
			";
			while($row = $result->fetch_assoc()) {
				echo "
					<tr>
						<tr onclick='navigateToStraipsnis(".$row['id'].")'>
						<td>".$row['pavadinimas']."</td>
						<td>".$row['tema']."</td>
						<td>".$row['tema']."</td>
						<td>".$row['sukurimo_data']."</td>
					</tr>
				";
			}
		?>

		<div>
		</div>
	</body>
</html>

<?php $dbc->close(); ?>
