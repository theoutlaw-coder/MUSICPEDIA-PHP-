<?php
session_start();
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Musicpedia</title>
    <link rel="stylesheet" href="CSS/izgledstranica.css">
</head>
<body>
    <nav class="navbar">
        <a href="pocetnastranica.php" class="izbornik">POCETNA</a>
        <a href="izvori.php" class="izbornik">IZVORI</a>
        <a href="popiszanrova.php" class="izbornik">POPIS ZANROVA</a>
        <a href="kontakt.php" class="izbornik">KONTAKT</a>
        
        <?php
        // Provjera je li korisnik prijavljen
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            // Ako je prijavljen, provjeravamo ulogu
            if (isset($_SESSION['uloga']) && $_SESSION['uloga'] === 'administrator') {
                // Administrator vidi link za koncerte
                echo '<a href="php/ispis.php" class="izbornik">ADMIN: KONCERTI</a>';
            } else {
                // Običan korisnik vidi kupovinu karata
                echo '<a href="php/ispis.php" class="izbornik">KUPOVINA KARATA</a>';
            }
        } else {
            // Ako nije prijavljen, vidi Login/Reg
            echo '<a href="php/register.php" class="izbornik">LOGIN/REG</a>';
        }
        ?>
    </nav>

    <h1><b>MUSICPEDIA</b></h1>
    <p>Dobrodošli na Musicpedia stranicu, nudimo Vam sve glavne glazbene žanrove, njihova najpoznatija djela i mogućnost kupnje karata za koncerte.</p>
</body>
</html>