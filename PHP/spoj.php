<?php
// Funkcija za spajanje na MySQL server
$spoj = mysqli_connect("localhost", "root", "");

// Provjera je li uspje�no ostvaren spoj na MySQL server
if (!$spoj) {
    die("<b>Do�lo je do pogre�ke i nismo se mogli spojiti na MySQL server</b>");
}

// Funkcija za odabir baze podataka na serveru
if (!mysqli_select_db($spoj, "musicpedia_db")) {
    // Provjera je li uspje�no odabrana baza podataka
    die("<b>Odabrana je pogre�na baza podataka.</b>");
}

// Ako smo do�li do ove tocke, spojili smo se na MySQL server i odabrali ispravnu bazu podataka.
// Mo�ete nastaviti s izvodenjem upita na bazi podataka.
?>
