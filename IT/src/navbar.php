<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
?>

<div class="navbar">
	<ul>
		<li>
			<a href="index.php">Straipsniai</a>
		</li>
		<li>
			<a href="task.php">Užduotis</a>
		</li>

		<?php if (isset($_SESSION['user_id'])): ?>
			<li class="dropdown">
				<a href="#" class="dropbtn">Temos</a>
				<div class="dropdown-content">
					<a href="topicChoose.php">Pasirinkti temas</a>
					<?php if ($_SESSION['user_role'] == 'Administrator'): ?>
						<a href="topicCreate.php">Kurti temą</a>
					<?php endif; ?>
				</div>
			</li>

			<?php if ($_SESSION['user_role'] == 'Publisher'): ?>
				<li class="dropdown">
					<a href="#" class="dropbtn">Mano straipsniai</a>
					<div class="dropdown-content">
						<a href="articlesMine.php">Mano sukurti straipsniai</a>
						<a href="articleCreate.php">Kurti straipsnį</a>
					</div>
				</li>
			<?php endif; ?>

			<li>
				<a href="articleRatings.php">Statistika</a>
			</li>

			<li class="dropdown">
				<a href="#" class="dropbtn">Kontaktai</a>
				<div class="dropdown-content">
					<a href="contacts.php">Konktatų sąrašas</a>
					<?php if ($_SESSION['user_role'] == 'Publisher'): ?>
						<a href="contactCreate.php">Kurti konktaktą</a>
					<?php endif; ?>
				</div>
			</li>

			<li class="dropdown">
				<a href="#" class="dropbtn"><?php echo htmlspecialchars($_SESSION['user_name_surname']); ?></a>
				<div class="dropdown-content">
					<a href="logout.php">Atsijungti</a>
				</div>
			</li>

		<?php else: ?>
			<li>
				<a href="login.php">Prisijungti</a>
			</li>
		<?php endif; ?>
	</ul>
</div>
