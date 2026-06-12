<?php
// Uključujemo spajanje na bazu
include "spoj.php";

// Provjeravamo je li ID poslan putem URL-a (npr. brisanje.php?id=1)
if (isset($_GET['id'])) {
    // Sigurnosna provjera: pretvaramo ID u cijeli broj
    $id = (int)$_GET['id'];

    // SQL upit za brisanje retka iz tablice 'koncerti'
    $sql_brisi = "DELETE FROM koncerti WHERE id = $id";

    // Izvršavamo upit
    if (mysqli_query($spoj, $sql_brisi)) {
        // Ako je brisanje uspješno, vraćamo korisnika na stranicu s ispisom
        header("Location: ispis.php");
        exit();
    } else {
        // Ako dođe do greške u bazi, ispisujemo poruku
        echo "Greška pri brisanju: " . mysqli_error($spoj);
    }
} else {
    // Ako korisnik pokuša pristupiti datoteci bez ID-a
    echo "Nije poslan ispravan ID za brisanje.";
}
?>