<?php
$server="localhost";
$user="stud";
$password="stud";
$dbname="stud";
$lentele="pratybos";
session_start();
// prisijungti prie duomenų bazės
$conn = new mysqli($server, $user, $password, $dbname);
 if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn,"utf8");// dėl lietuviškų raidžių

//Nuskaitymas
// $sql =  "SELECT * FROM $lentele";

if ($_SESSION['ulevel'] ==4){
     $vardas=$_SESSION['user'];
     $sql = "SELECT * FROM $lentele WHERE siuntejas = '$vardas' OR gavejas = '$vardas'";
}
else $sql =  "SELECT * FROM $lentele";  

if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);

// parodyti
echo "<table border=\"1\">";
while($row = $result->fetch_assoc()) {
  echo "<tr>
     <td>".$row['id']."</td>
     <td>".$row['siuntejas']."</td>
     <td>".$row['gavejas']."</td>
	 <td>".$row['zinute']."</td>
     <td>".$row['el_pastas']."</td>
  </tr>";
}
echo "<a href=\"ivedimas.html\">Dar kartą</a>";
echo "<br/>";
echo "<a href=\"index.php\">Grizti</a>";
echo "</table>";

?>