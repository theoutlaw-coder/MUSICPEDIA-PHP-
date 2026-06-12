<?php session_start(); if (!isset($_SESSION['loggedin'])) { header("Location: login.php"); exit; } include "spoj.php"; 
if (isset($_POST["spremanje"])) {
    mysqli_query($spoj, "INSERT INTO koncerti (bend, datum_koncerta, vrijeme, mjesto, cijena) VALUES ('{$_POST['bend']}', '{$_POST['datum']}', '{$_POST['vrijeme']}', '{$_POST['mjesto']}', '{$_POST['cijena']}')");
    header("Location: ispis.php"); exit();
} ?>
<!DOCTYPE html>
<html lang="hr">
<head><link rel="stylesheet" href="../CSS/phpcss.css"></head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h1>Unos novog koncerta</h1>
        <form method="post">
            <input type="text" name="bend" placeholder="Naziv benda" required>
            <input type="text" name="datum" placeholder="Datum (gggg-mm-dd)">
            <input type="text" name="vrijeme" placeholder="Vrijeme (npr. 20:00)">
            <input type="text" name="mjesto" placeholder="Mjesto održavanja">
            <input type="text" name="cijena" placeholder="Cijena €" required>
            <button type="submit" name="spremanje" class="btn-crud">Spremi</button>
        </form>
    </div>
</body>
</html>