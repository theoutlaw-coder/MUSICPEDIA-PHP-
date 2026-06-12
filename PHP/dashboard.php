<?php session_start(); if (!isset($_SESSION['loggedin'])) { header("Location: login.php"); exit; } include "spoj.php"; ?>
<!DOCTYPE html>
<html lang="hr">
<head><link rel="stylesheet" href="../CSS/phpcss.css"></head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h1>Dobrodošao, <?php echo $_SESSION['username']; ?>!</h1>
        <hr>
        <?php if ($_SESSION['uloga'] == 'administrator'): ?>
            <div class="stats">
                <h3>Statistika:</h3>
                <?php
                echo "<p>Korisnika: ".mysqli_num_rows(mysqli_query($spoj, "SELECT id FROM users"))."</p>";
                echo "<p>Narudžbi: ".mysqli_num_rows(mysqli_query($spoj, "SELECT id FROM narudzbe"))."</p>";
                ?>
                <a href="unos.php" class="btn-crud">Dodaj novi koncert</a>
            </div>
        <?php else: ?>
            <div class="stats">
                <h3>Aktivnosti</h3>
                <?php echo "<p>Tvojih narudžbi: ".mysqli_num_rows(mysqli_query($spoj, "SELECT id FROM narudzbe WHERE user_id = '{$_SESSION['user_id']}'"))."</p>"; ?>
                <a href="ispis.php" class="btn-plavi">Pregledaj koncerte</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>