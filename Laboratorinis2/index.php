<!DOCTYPE html>
<html>
<head>
	<title>Lab2</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style>
		#zinutes {
		   font-family: Arial; border-collapse: collapse; width: 70%;
		}
		#zinutes td {
		   border: 1px solid #ddd; padding: 8px;
		}
		#zinutes tr:nth-child(even){background-color: #f2f2f2;}
		#zinutes tr:hover {background-color: #ddd;}
		#zinutes th { background-color: #FFFF8F };
	</style>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>

<body>
<center><h3>Žinučių sistema</h3></center>

<?php
	$server = "localhost";
	$db = "stud";
	$user = "stud";
	$password = "stud";
	$lentele = "simasbradaitis";
	$dbc = mysqli_connect($server,$user,$password, $db);
	if(!$dbc){ die ("Negaliu prisijungti prie MySQL:" .mysqli_error($dbc)); }
	if($_POST != null){
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
