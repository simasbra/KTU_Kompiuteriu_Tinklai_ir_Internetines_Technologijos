<div class="navbar">
    <ul>
        <li><a href="index.php">Pradinis puslapis</a></li>
        <li><a href="task.php">Užduotis</a></li>
        <li><a href="">Mano straipsniai</a></li>
        <li><a href="articleCreate.php">Kurti straipsni</a></li>
        <li><a href="">Statistika</a></li>

        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- User is logged in -->
            <li><a href="logout.php">Atsijungti</a></li>
            <li><a href=""><?php echo htmlspecialchars($_SESSION['username']); ?> <?php echo htmlspecialchars($_SESSION['user_name']); ?></a></li>
        <?php else: ?>
            <!-- User is not logged in -->
            <li><a href="login.php">Prisijungti</a></li>
        <?php endif; ?>
    </ul>
</div>
