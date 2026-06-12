<?php 
session_start(); 
include "spoj.php"; 

if (!isset($_GET['id'])) die("Nema narudžbe."); 
$id = (int)$_GET['id'];

// Dohvat podataka
$narudzba = mysqli_fetch_assoc(mysqli_query($spoj, "SELECT * FROM narudzbe WHERE id = $id"));
$kupac = mysqli_fetch_assoc(mysqli_query($spoj, "SELECT *, IBAN AS k_iban FROM users WHERE id = '{$narudzba['user_id']}'"));
$admin = mysqli_fetch_assoc(mysqli_query($spoj, "SELECT * FROM users WHERE uloga = 'administrator' LIMIT 1"));

$stavke = !empty($narudzba['opis']) ? explode(";", $narudzba['opis']) : [];
$dt = explode(" ", $narudzba['datum_kupnje']);
$ukupno = (float)$narudzba['ukupna_cijena'];
$neto = $ukupno / 1.25;
$pdv = $ukupno - $neto;
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/phpcss.css">
    <style>
        /* Navigacija - konzistentna s ostalim stranicama */
        .navbar { background-color: #000; padding: 15px; border-bottom: 2px solid #e60000; margin-bottom: 20px; text-align: left; }
        .navbar a { color: #ff0000; text-decoration: none; margin-right: 20px; font-weight: bold; font-family: Arial; }
        
        /* Dizajn računa */
        body { background-color: #1a1a1a; font-family: Arial, sans-serif; margin: 0; }
        .racun-container { width: 80%; margin: 40px auto; border: 1px solid #000; padding: 40px; background: #fff !important; color: #000 !important; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
        .info-red { display: flex; justify-content: space-between; margin: 20px 0; padding: 10px 0; border-top: 1px solid #000; border-bottom: 1px solid #000; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000 !important; padding: 10px; text-align: left; }
        .btn-print { background: #e60000; color: white; border: none; padding: 10px 20px; cursor: pointer; margin-top: 20px; }
        
        /* Skrivanje navbar-a kod ispisa */
        @media print { .navbar, .btn-print { display: none; } body { background-color: #fff; } .racun-container { border: none; margin: 0; width: 100%; } }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="racun-container">
        <h1>RAČUN BR. <?php echo $id; ?></h1>
        <div class="grid">
            <div><h3>Prodavatelj:</h3><?php echo $admin['ime'].' '.$admin['prezime']; ?><br>OIB: <?php echo $admin['oib']; ?><br>IBAN: <?php echo $admin['IBAN']; ?></div>
            <div><h3>Kupac:</h3><?php echo $kupac['ime'].' '.$kupac['prezime']; ?><br>OIB: <?php echo $kupac['oib']; ?><br>IBAN: <?php echo $kupac['k_iban']; ?></div>
        </div>
        
        <div class="info-red">
            <div><strong>Datum:</strong> <?php echo $dt[0]; ?><br><strong>Vrijeme:</strong> <?php echo $dt[1]; ?></div>
            <div><strong>Datum isporuke:</strong> <?php echo $narudzba['datum_isporuke'] ?: $dt[0]; ?></div>
            <div><strong>Vrsta plaćanja:</strong> <?php echo $narudzba['vrsta_placanja']; ?></div>
        </div>
        
        <table>
            <thead><tr><th>Naziv</th><th>Kol</th><th>Cijena</th><th>Ukupno</th></tr></thead>
            <tbody>
                <?php foreach($stavke as $s) { 
                    $p = explode("|", $s); 
                    if(count($p) >= 4) echo "<tr><td>{$p[0]}</td><td>{$p[1]}</td><td>{$p[2]} €</td><td>{$p[3]} €</td></tr>"; 
                } ?>
            </tbody>
        </table>
        
        <div style="text-align:right; margin-top:20px;">
            <p>Neto: <?php echo number_format($neto, 2); ?> €</p>
            <p>PDV (25%): <?php echo number_format($pdv, 2); ?> €</p>
            <h3>Ukupno za platiti: <?php echo number_format($ukupno, 2); ?> €</h3>
        </div>
        
        <button onclick="window.print()" class="btn-print">Ispiši račun</button>
    </div>
</body>
</html>