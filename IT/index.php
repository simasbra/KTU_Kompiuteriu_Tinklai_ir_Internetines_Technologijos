<!DOCTYPE html>

<?php
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
	<head>
		<title>IT projektas</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>

	<script>
		function navigateToStraipsnis(id) {
			window.location.href = 'straipsnis.php?id=' + id;
		}
	</script>

	<body>
		<div>
			<center>
				<h1>Asmeninio/profesinio augimo konsultavimo internetu svetainė</h1>
				<h3>Simas Bradaitis</h3>
			</center>
		</div>

		<div>
			<ul>
				<li><a href="index.php">Pradinis puslapis</a></li>
				<li><a href="uzduotis.html">Užduotis</a></li>
				<li><a href="">Mano straipsniai</a></li>
				<li><a href="">Kurti straipsni</a></li>
				<li><a href="">Statistika</a></li>
				<li><a href="">Prisijungti</a></li>
			</ul>
		</div>

		<?php
			$sql =  "SELECT * FROM $table";  

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
