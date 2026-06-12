<?php
session_start();
// Provjera je li korisnik uopće prijavljen
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

include "spoj.php";
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Kupovina karata</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1>Popis koncerata</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Bend</th>
                <th>Datum</th>
                <th>Cijena</th>
                <th>Akcija</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM koncerti";
        $result = mysqli_query($spoj, $sql);
        
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['bend'] . "</td>";
            echo "<td>" . $row['datum_koncerta'] . "</td>";
            echo "<td>" . $row['cijena'] . " €</td>";
            echo "<td>";
            
            // Svi vide gumb za kupovinu
            echo "<button class='btn btn-success btn-sm'>Kupi kartu</button> ";
            
            // SAMO ADMIN vidi gumbove za uređivanje i brisanje
            if ($_SESSION['uloga'] == 'administrator') {
                echo "<a href='izmjeni.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Uredi</a> ";
                echo "<a href='obrisi.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Obriši</a>";
            }
            
            echo "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <a href="dashboard.php" class="btn btn-secondary">Povratak na Dashboard</a>
</body>
</html>