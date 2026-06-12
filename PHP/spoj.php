<?php

$spoj = mysqli_connect("localhost", "root", "");

if (!$spoj) {
    die("<b>Do�lo je do pogre�ke i nismo se mogli spojiti na MySQL server</b>");
}

if (!mysqli_select_db($spoj, "musicpedia_db")) {
    die("<b>Odabrana je pogre�na baza podataka.</b>");
}


?>
