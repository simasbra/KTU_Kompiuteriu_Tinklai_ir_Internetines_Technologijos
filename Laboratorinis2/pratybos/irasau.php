<?php
$server="localhost";
$user="stud";
$password="stud";
$dbname="stud";
$lentele="pratybos";

// prisijungti prie duomenų bazės
$conn = new mysqli($server, $user, $password, $dbname);
 if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn,"utf8");// dėl lietuviškų raidžių

//Formos reikšmių nuskaitymas

session_start();

// Įrašymas į DB
	if($_POST !=null){
       // $AAA = $_POST['siuntejas'];
		$AAA = $_SESSION['user'];
       $BBB =$_POST['gavejas'];
       // $CCC = $_POST['el_pastas'];
		$CCC = $_SESSION['umail'];
	   $DDD = htmlspecialchars($_POST['zinute']);

      $sql = "INSERT INTO $lentele (siuntejas, gavejas, zinute, el_pastas) 
             VALUES ('$AAA', '$BBB', '$DDD', '$CCC')";
      if (!$result = $conn->query($sql)) die("Negaliu įrašyti: " . $conn->error);
      // else echo "Įrašyta";
		header("Location:skaitau.php");
exit;
}

?>