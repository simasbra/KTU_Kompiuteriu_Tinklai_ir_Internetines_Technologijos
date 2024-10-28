<!DOCTYPE html>

<html>
<head>
<title>Lab2</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
 </script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js">
</script>
<style>
	#zinutes
	{
 	   font-family: Arial; border-collapse: collapse; width: 70%;
	}
	#zinutes td {
 	   border: 1px solid #ddd; padding: 8px;
	}
	#zinutes tr:nth-child(even){background-color: #f2f2f2;}
	#zinutes tr:hover {background-color: #ddd;}
</style>


</head>

<body>
	<center><h3>Žinučių sistema</h3></center>
<?php
$server = "localhost";
$db = "stud";
$user = "stud";
	
$password = "stud";
$lentele = "pratyboms"

// prisijungimas prie DB
$dbc=mysqli_connect($server,$user,$password, $db);
if(!$dbc){ die ("Negaliu prisijungti prie MySQL:"	.mysqli_error($dbc)); }
//if (isset($_POST["ok"]))
if($_POST !=null){
// įrašyti reikšmes iš formos
	$siuntejas = $_POST['siuntejas'];
	$gavejas = $_POST['gavejas'];
	$epastas =$_POST['epastas'];
	$zinute = htmlspecialchars($_POST['zinute']);

	$sql = "INSERT INTO $lentele (siuntejas, gavejas, zinute, epastas, data ) VALUES ('$siuntejas','$gavejas','$zinute', '$epastas', NOW())";
		if (!mysqli_query($dbc, $sql))  die ("Klaida įrašant:" .mysqli_error($dbc));
		echo "Įrašyta";	
		//header('Location: index.php');
		//exit();
}
?>
<table style="margin: 0px auto;" id="zinutes">     
	<th>Nr</th>
	<th>Siuntejas</th>
	<th>Gavejas</th>
	<th>Zinute</th>
	<th>El. Pastas</th>
	<th>Data</th>
<?php
$sql = "SELECT * FROM $lentele";
    $result = mysqli_query($dbc, $sql);
	while($row = mysqli_fetch_assoc($result))
	{
		echo "<tr>
		<td>".$row['id']."</td>
		<td>".$row['siuntejas']."</td>
        <td>".$row['gavejas']."</td>
		<td>".$row['zinute']."</td>
		<td>".$row['epastas']."</td>
		<td>".$row['data']."</td>
		</tr>";
	} 
?>
</table>
	
<div class="container">
  <form method='post'>
     <div class="form-group col-lg-4">
          <label for="siuntejas" class="control-label">Siuntėjo vardas:</label>
          <input name='siuntejas' type='text' class="form-control input-sm">
      </div>
	  <div class="form-group col-lg-4">
          <label for="gavejas" class="control-label">Gavejas:</label>
          <input name='gavejas' type='text' class="form-control input-sm">
      </div>
	  <div class="form-group col-lg-4">
          <label for="epastas" class="control-label">Siuntėjo e-paštas:</label>
          <input name='epastas' id="epastas" type='email' class="form-control input-sm">
      </div>
	  <div class="form-group col-lg-12">
          <label for="zinute" class="control-label">Žinutė:</label>
          <textarea name='zinute' class="form-control input-sm"></textarea>
      </div>
	        <div class="form-group col-lg-2">
         <input type='submit' name='ok' value='siųsti' class="btnbtn-default">
      </div>
  </form>
</div>
	
    <button onclick="window.location.href='automobilis.html';">
      Automobilis
    </button>
	<a href="bootstrap_automobilis.html">Bootstrap automobilis</a>

	
</body>

</html>