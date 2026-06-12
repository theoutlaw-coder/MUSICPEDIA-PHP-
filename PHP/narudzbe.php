<?php session_start(); if (!isset($_SESSION['loggedin'])) { header("Location: login.php"); exit; } include "spoj.php"; ?>
<!DOCTYPE html>
<html lang="hr">
<head><link rel="stylesheet" href="../CSS/phpcss.css"></head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h1><?php echo ($_SESSION['uloga'] == 'administrator') ? 'Sve narudžbe' : 'Moje narudžbe'; ?></h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Br. narudžbe</th>
                    <?php if ($_SESSION['uloga'] == 'administrator') { echo '<th>ID</th>'; } ?>
                    <th>Korisnik</th>
                    <th>Detalji</th>
                    <th>Ukupno</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $sql = ($_SESSION['uloga'] == 'administrator') ? "SELECT * FROM narudzbe" : "SELECT * FROM narudzbe WHERE user_id = '{$_SESSION['user_id']}'";
            $rez = mysqli_query($spoj, $sql);
            $broj_narudzbe = 1;
            
            while ($row = mysqli_fetch_assoc($rez)) {
                $stavke_niz = explode(";", $row['opis']);
                echo "<tr>
                        <td>{$broj_narudzbe}</td>";
                
                // Prikaz ID-a samo za administratora
                if ($_SESSION['uloga'] == 'administrator') {
                    echo "<td>{$row['id']}</td>";
                }
                
                echo "  <td>{$row['username']}</td>
                        <td>
                            <table style='width:100%; border-collapse:collapse;'>
                                <tr><th>Bend</th><th>Mjesto</th><th>Vrijeme</th><th>Kol</th><th>Ukupno</th></tr>";
                foreach($stavke_niz as $s) {
                    $p = explode("|", $s);
                    if(count($p) >= 6) {
                        echo "<tr><td>{$p[0]}</td><td>{$p[4]}</td><td>{$p[5]}</td><td>{$p[1]}</td><td>{$p[3]}€</td></tr>";
                    }
                }
                echo "      </table>
                        </td>
                        <td>{$row['ukupna_cijena']} €</td>
                      </tr>";
                $broj_narudzbe++;
            } ?>
            </tbody>
        </table>
    </div>
</body>
</html>