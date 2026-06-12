<?php
session_start();
include "spoj.php";

// Provjera je li korisnik ulogiran (preporučeno)
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // SQL upit za brisanje
    $sql_brisi = "DELETE FROM koncerti WHERE id = $id";

    if (mysqli_query($spoj, $sql_brisi)) {
        // Uspješno obrisano, vrati na ispis
        header("Location: ispis.php");
        exit();
    } else {
        echo "Greška pri brisanju: " . mysqli_error($spoj);
    }
} else {
    echo "Nije poslan ID za brisanje.";
}
?>