<?php 
session_start(); 
if (!isset($_SESSION['loggedin']) || $_SESSION['uloga'] !== 'administrator') { header("Location: login.php"); exit; }
include "spoj.php"; 
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Arhiva računa</title>
    <link rel="stylesheet" href="../CSS/phpcss.css">
    <style>
        body { background-color: #1a1a1a !important; color: #ccc !important; font-family: Arial, sans-serif; }
        .naslov-arhive { text-align: center; color: #ffffff !important; margin: 30px 0; }
        .racun-papir { width: 85%; margin: 40px auto; background: #ffffff !important; border: 1px solid #ccc; padding: 30px; color: #000 !important; box-shadow: 0 0 10px rgba(0,0,0,0.5); }
        .header-info { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; border-top: 1px solid #000; padding-top: 10px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; background-color: #ffffff !important; color: #000 !important; }
        .table th, .table td { border: 1px solid #000 !important; padding: 10px; text-align: left; color: #000 !important; background-color: #ffffff !important; }
        .racun-papir div, .racun-papir p, .racun-papir h2, .racun-papir h3 { color: #000 !important; }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container">
        <h1 class="naslov-arhive">Arhiva svih računa</h1>
        <?php
        $res = mysqli_query($spoj, "SELECT n.*, u.ime, u.prezime, u.adresa, u.oib, u.IBAN AS kupac_iban FROM narudzbe n JOIN users u ON n.user_id = u.id ORDER BY n.id ASC");
        $admin = mysqli_fetch_assoc(mysqli_query($spoj, "SELECT * FROM users WHERE uloga = 'administrator' LIMIT 1"));

        while($narudzba = mysqli_fetch_assoc($res)) {
            $stavke = !empty($narudzba['opis']) ? explode(";", $narudzba['opis']) : [];
            $ukupno = (float)$narudzba['ukupna_cijena'];
            $neto = $ukupno / 1.25;
            $pdv = $ukupno - $neto;
            $datum_vrijeme = explode(" ", $narudzba['datum_kupnje']);
        ?>
            <div class="racun-papir">
                <div class="header-info">
                    <div><strong>Prodavatelj:</strong><br><?php echo $admin['ime'].' '.$admin['prezime']; ?><br>OIB: <?php echo $admin['oib']; ?><br>IBAN: <?php echo $admin['IBAN']; ?></div>
                    <div><strong>Kupac:</strong><br><?php echo $narudzba['ime'].' '.$narudzba['prezime']; ?><br>OIB: <?php echo $narudzba['oib']; ?><br>IBAN: <?php echo $narudzba['kupac_iban']; ?></div>
                </div>
                <div class="info-grid">
                    <div><strong>Datum:</strong> <?php echo $datum_vrijeme[0]; ?><br><strong>Vrijeme:</strong> <?php echo $datum_vrijeme[1]; ?></div>
                    <div><strong>Datum isporuke:</strong> <?php echo $narudzba['datum_isporuke'] ?: $datum_vrijeme[0]; ?><br><strong>Vrsta plaćanja:</strong> <?php echo $narudzba['vrsta_placanja']; ?></div>
                </div>
                <h2>RAČUN BR. <?php echo $narudzba['id']; ?></h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Naziv</th>
                            <th>Mjesto</th>
                            <th>Vrijeme</th>
                            <th>Kol</th>
                            <th>Cijena</th>
                            <th>Ukupno</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($stavke as $s) { 
                            $p = explode("|", $s); 
                            if(count($p) >= 6) {
                                echo "<tr>
                                        <td>{$p[0]}</td>
                                        <td>{$p[4]}</td>
                                        <td>{$p[5]}</td>
                                        <td>{$p[1]}</td>
                                        <td>{$p[2]} €</td>
                                        <td>{$p[3]} €</td>
                                      </tr>";
                            }
                        } ?>
                    </tbody>
                </table>
                <div style="text-align:right; margin-top:15px;">
                    <p>Neto: <?php echo number_format($neto, 2); ?> €</p>
                    <p>PDV (25%): <?php echo number_format($pdv, 2); ?> €</p>
                    <h3>Ukupno: <?php echo number_format($ukupno, 2); ?> €</h3>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>
