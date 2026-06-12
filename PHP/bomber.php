<?php
session_start();
// Provjera je li korisnik uopće prijavljen
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Musicpedia - Home</title>
    <link rel="stylesheet" href="../CSS/phpcss.css">
</head>
<body>

    <nav class="navbar">
        <a href="home.php">Home</a>
        <a href="ispis.php">Popis koncerata</a>
        <a href="unos.php">Dodaj koncert</a>
        <a href="logout.php">Logout</a>
    </nav>

    <div class="container">
        <h1>Musicpedia</h1>
        <p>Dobrodošao u sustav za upravljanje koncertima. Koristi navigaciju iznad za pregled ili unos novih koncerata.</p>
    </div>

</body>
</html>