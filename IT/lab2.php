<!DOCTYPE html>
<html>
<head>
	<title>IT projektas</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
<center>
	<h1>Asmeninio/profesinio augimo konsultavimo internetu svetainė</h1>
	<br>
	<h3>Simas Bradaitis</h3>
</center>

<?php
	$server = "localhost";
	$db = "stud";
	$user = "stud";
	$password = "stud";
	$lentele = "simasbradaitis";
	$dbc = mysqli_connect($server,$user,$password, $db);
	if(!$dbc){ die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }

	// if($_POST != null){
	if (isset($_POST['ok'])) {
		$vardas = $_POST['vardas'];
		$epastas = $_POST['epastas'];
		$kam = $_POST['kam'];
		$zinute = htmlspecialchars($_POST['zinute']);
		$sql = "INSERT INTO $lentele (vardas, epastas, kam, data, zinute)
			VALUES ('$vardas', '$epastas', '$kam', NOW(), '$zinute')";
		if (!mysqli_query($dbc, $sql))  die ("Klaida įrašant:" .mysqli_error($dbc));
		echo "Įrašyta";
		//exit();
	}

	if (isset($_POST['delete'])) {
		if (!empty($_POST['vardas'])) {
			$vardas = $_POST['vardas'];
			$sql = "DELETE FROM $lentele WHERE siuntejas='$vardas'";
			if (!$result = $dbc->query($sql)) die("Negaliu ištrinti: " . $dbc->error);
			header("Location:index.php");
		}
	}

	$sql =  "SELECT * FROM $lentele";  

	if (!$result = $dbc->query($sql)) die("Negaliu nuskaityti: " . $dbc->error);

	echo "<br/>";
	echo "<table style='margin: 0px auto;' id='zinutes'>";
	echo "
		<tr>
			<th>Nr.</th>
			<th>Kas siuntė</th>
			<th>Siuntėjo e-paštas</th>
			<th>Gavėjas</th>
			<th>Data</th>
			<th>Žinutė</th>
		</tr>
	";
	while($row = $result->fetch_assoc()) {
		echo "
			<tr>
				<td>".$row['id']."</td>
				<td>".$row['vardas']."</td>
				<td>".$row['epastas']."</td>
				<td>".$row['kam']."</td>
				<td>".$row['data']."</td>
				<td>".$row['zinute']."</td>
			</tr>
		";
	}
	echo "
		<tr>
			<td colspan='6' style='background-color: #FFFF8F'>
			Darba atliko Simas Bradaitis
			</td>
		</tr>
	";
	echo "</table>";
?>

<center><h3>Įveskite žinutę</h3></center>
<br/>
<div class="container">
	<form method='post'>
		<div class="form-group col-sm-4">
			<label for="vardas" class="control-label">Siuntėjo vardas:</label>
			<input name='vardas' type='text' class="form-control input-sm">
		</div>
		<div class="form-group col-sm-4">
			<label for="epastas" class="control-label">Siuntėjo e-paštas:</label>
			<input name='epastas' id="epastas" type='email' class="form-control input-sm">
		</div>
		<div class="form-group col-sm-4">
			<label for="kam" class="control-label">Kam skirta:</label>
			<input name='kam' type='text' class="form-control input-sm">
		</div>
		<div class="form-group col-lg-12">
			<label for="zinute" class="control-label">Žinutė:</label>
			<textarea name='zinute' class="form-control input-sm"></textarea>
		</div>
		<div class="form-group col-sm-2">
			<input type='submit' name='ok' value='siųsti' class="btn btn-default">
		</div>
		<div class="form-group col-sm-4">
			<label for="vardas" class="control-label">Siuntėjo vardas:</label>
			<input name='vardas' type='text' class="form-control input-sm">
		</div>
		<div class="form-group col-lg-4">
			<input type='submit' name='delete' value='Naikinti' class="btn btn-default">
		</div>
	</form>
	<div class="form-group col-sm-2">
		<button onclick="window.location.href='automobilis.html';">Toliau</button>
	</div>
	<div class="form-group col-sm-8">
		<a href="bootstrap_automobilis.html">Toliau į bootstrap_automobilis.html</a>
	</div>
</div>
</body>
</html>
