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
    <style>
        body { background-color: #1a1a1a !important; color: #ccc !important; font-family: Arial, sans-serif; }
        .racun-papir { width: 85%; margin: 40px auto; background: #ffffff !important; border: 1px solid #ccc; padding: 30px; color: #000 !important; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #000 !important; padding: 10px; text-align: left; color: #000 !important; background-color: #ffffff !important; }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h1 style="text-align:center; color:white;">Arhiva svih računa</h1>
        <?php
        $res = mysqli_query($spoj, "SELECT n.*, u.ime, u.prezime, u.oib, u.IBAN AS kupac_iban FROM narudzbe n JOIN users u ON n.user_id = u.id ORDER BY n.id ASC");
        $admin = mysqli_fetch_assoc(mysqli_query($spoj, "SELECT * FROM users WHERE uloga = 'administrator' LIMIT 1"));
        while($narudzba = mysqli_fetch_assoc($res)) {
            $stavke = !empty($narudzba['opis']) ? explode(";", $narudzba['opis']) : [];
        ?>
            <div class="racun-papir">
                <h3>RAČUN BR. <?php echo $narudzba['id']; ?></h3>
                <table class="table">
                    <thead><tr><th>Naziv</th><th>Mjesto</th><th>Vrijeme</th><th>Kol</th><th>Cijena</th><th>Ukupno</th></tr></thead>
                    <tbody>
                        <?php foreach($stavke as $s) { 
                            $p = explode("|", $s); 
                            if(count($p) >= 6) echo "<tr><td>{$p[0]}</td><td>{$p[4]}</td><td>{$p[5]}</td><td>{$p[1]}</td><td>{$p[2]} €</td><td>{$p[3]} €</td></tr>"; 
                        } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</body>
</html>
