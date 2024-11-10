<div class="navbar">
    <ul>
        <li><a href="index.php">Pradinis puslapis</a></li>
        <li><a href="task.php">Užduotis</a></li>
        <li><a href="">Mano straipsniai</a></li>
        <li><a href="articleCreate.php">Kurti straipsni</a></li>
        <li><a href="">Statistika</a></li>

        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- User profile with dropdown -->
            <li class="dropdown">
                <a href="#" class="dropbtn"><?php echo htmlspecialchars($_SESSION['user_name']); ?></a>
                <div class="dropdown-content">
                    <a href="profile.php">Profilis</a>
                    <a href="logout.php">Atsijungti</a>
                </div>
            </li>
        <?php else: ?>
            <!-- User is not logged in -->
            <li><a href="login.php">Prisijungti</a></li>
        <?php endif; ?>
    </ul>
</div>