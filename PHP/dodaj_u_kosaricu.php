<?php
session_start();
include "spoj.php";

if (isset($_GET['id']) && $_SESSION['uloga'] == 'korisnik') {
    $koncert_id = (int)$_GET['id'];
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];

    // 1. Provjeri postoji li već isti koncert u košarici tog korisnika
    $check_query = "SELECT id, kolicina FROM kosarica WHERE koncert_id = $koncert_id AND user_id = $user_id";
    $result = mysqli_query($spoj, $check_query);

    if (mysqli_num_rows($result) > 0) {
        // 2. Ako postoji, samo povećaj količinu za 1
        mysqli_query($spoj, "UPDATE kosarica SET kolicina = kolicina + 1 WHERE koncert_id = $koncert_id AND user_id = $user_id");
    } else {
        // 3. Ako ne postoji, dodaj novi zapis s količinom 1
        mysqli_query($spoj, "INSERT INTO kosarica (user_id, username, koncert_id, kolicina) VALUES ('$user_id', '$username', '$koncert_id', 1)");
    }
}

header("Location: ispis.php");
exit();
?>