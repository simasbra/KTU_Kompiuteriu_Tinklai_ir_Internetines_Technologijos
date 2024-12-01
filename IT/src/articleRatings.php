<?php
$server = "localhost";
$db = "IT";
$user = "stud";
$password = "stud";
$connection = mysqli_connect($server, $user, $password, $db);

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if (!$connection) {
	die("Prisijungimas prie duomenų bazės nepavyko: " . mysqli_connect_error());
}

$sql = "
	SELECT
		Tema.pavadinimas,
		COUNT(Straipsnis.id) AS straipsniu_skaicius
	FROM Straipsnis
	JOIN Tema ON Straipsnis.tema_id = Tema.id
	GROUP BY Tema.pavadinimas
	ORDER BY straipsniu_skaicius DESC
	LIMIT 5
";

$result = mysqli_query($connection, $sql);
$topics = [];

if ($result && mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		$topics[] = $row;
	}
} else {
	$topics = [];
}

mysqli_close($connection);
?>

<!DOCTYPE html>

<html lang="lt">

<?php include "headGimmeHead.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>

	<?php include 'navbar.php'; ?>

	<h1>Populiariausios 5 Temos</h1>

	<div style="width: 50%; margin: auto;">
		<canvas id="barChart"></canvas>
	</div>
	<div style="width: 50%; margin: auto;">
		<canvas id="pieChart"></canvas>
	</div>

	<script>
		var topics = <?php echo json_encode($topics); ?>;

		if (topics.length > 0) {
			var labels = topics.map(function (topic) {
				return topic.pavadinimas;
			});
			var values = topics.map(function (topic) {
				return topic.straipsniu_skaicius;
			});

			var ctxBar = document.getElementById('barChart').getContext('2d');
			var barChart = new Chart(ctxBar, {
				type: 'bar',
				data: {
					labels: labels,
					datasets: [{
						label: 'Straipsnių skaičius',
						data: values,
						backgroundColor: ['#4CAF50', '#FF9800', '#2196F3', '#F44336', '#9C27B0'],
						borderColor: ['#388E3C', '#F57C00', '#1976D2', '#D32F2F', '#7B1FA2'],
						borderWidth: 1
					}]
				},
				options: {
					responsive: true,
					scales: {
						y: {
							beginAtZero: true
						}
					}
				}
			});

			var ctxPie = document.getElementById('pieChart').getContext('2d');
			var pieChart = new Chart(ctxPie, {
				type: 'pie',
				data: {
					labels: labels,
					datasets: [{
						label: 'Straipsnių skaičius',
						data: values,
						backgroundColor: ['#4CAF50', '#FF9800', '#2196F3', '#F44336', '#9C27B0']
					}]
				},
				options: {
					responsive: true
				}
			});
		} else {
			document.getElementById('barChart').getContext('2d').font = "20px Arial";
			document.getElementById('barChart').getContext('2d').fillText("Nėra duomenų", 100, 100);

			document.getElementById('pieChart').getContext('2d').font = "20px Arial";
			document.getElementById('pieChart').getContext('2d').fillText("Nėra duomenų", 100, 100);
		}
	</script>

</body>
</html>
