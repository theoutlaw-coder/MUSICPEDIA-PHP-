<?php session_start(); if (!isset($_SESSION['loggedin'])) { header("Location: login.php"); exit; } include "spoj.php"; ?>
<!DOCTYPE html>
<html lang="hr">
<head><link rel="stylesheet" href="../CSS/phpcss.css"></head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h1>Pregled koncerata</h1>
        <table class="table">
            <thead><tr><th>Bend</th><th>Datum</th><th>Vrijeme</th><th>Mjesto</th><th>Cijena</th><th>Akcija</th></tr></thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM koncerti";
            $rezultat = mysqli_query($spoj, $sql);
            while ($redak = mysqli_fetch_array($rezultat)) {
                echo "<tr><td>{$redak['bend']}</td><td>{$redak['datum_koncerta']}</td><td>{$redak['vrijeme']}</td><td>{$redak['mjesto']}</td><td>{$redak['cijena']} €</td><td>";
                if ($_SESSION['uloga'] == 'administrator') {
                    echo "<a href='izmjeni.php?id={$redak['id']}' class='btn-crud'>Uredi</a> 
                          <a href='brisanje.php?id={$redak['id']}' class='btn-crud' style='background-color: #8b0000;' onclick='return confirm(\"Sigurno obrisati?\")'>Obriši</a>";
                } else {
                    echo "<a href='dodaj_u_kosaricu.php?id={$redak['id']}' class='btn-plavi'>Kupi</a>";
                }
                echo "</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>