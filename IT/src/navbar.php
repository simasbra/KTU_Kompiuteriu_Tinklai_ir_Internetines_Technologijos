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
			<?php if ($_SESSION['user_role'] == 'Publisher'): ?>
				<li>
					<a href="articlesMine.php">Mano straipsniai</a>
				</li>
				<li>
					<a href="articleCreate.php">Kurti straipsnį</a>
				</li>
			<?php endif; ?>

			<?php if ($_SESSION['user_role'] == 'Administrator'): ?>
				<li>
					<a href="topicCreate.php">Kurti temą</a>
				</li>
			<?php endif; ?>

			<li>
				<a href="#">Statistika</a>
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
