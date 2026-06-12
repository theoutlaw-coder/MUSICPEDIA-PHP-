<?php
session_start();
// Ograniči pristup samo administratoru
if (!isset($_SESSION['uloga']) || $_SESSION['uloga'] !== 'administrator') {
    die("Pristup zabranjen.");
}
include "spoj.php";

if(isset($_POST['spremi'])) {
    $bend = mysqli_real_escape_string($spoj, $_POST['bend']);
    $datum = $_POST['datum'];
    $cijena = $_POST['cijena'];

    $sql = "INSERT INTO koncerti (bend, datum_koncerta, cijena) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($spoj, $sql);
    mysqli_stmt_bind_param($stmt, "ssd", $bend, $datum, $cijena);
    
    if(mysqli_stmt_execute($stmt)) {
        echo "Koncert uspješno dodan! <a href='kupovina.php'>Vrati se na listu</a>";
    } else {
        echo "Greška: " . mysqli_error($spoj);
    }
}
?>

<form method="post">
    <input type="text" name="bend" placeholder="Ime benda" required>
    <input type="date" name="datum" required>
    <input type="number" step="0.01" name="cijena" placeholder="Cijena" required>
    <button type="submit" name="spremi">Spremi koncert</button>
</form>