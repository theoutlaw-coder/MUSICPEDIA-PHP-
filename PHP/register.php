<?php
include "spoj.php";
if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $adresa = $_POST['adresa'];
    $oib = $_POST['oib'];
    $iban = $_POST['iban'];
    
    $stmt = $spoj->prepare("INSERT INTO users (username, password, uloga, ime, prezime, adresa, oib, IBAN) VALUES (?, ?, 'korisnik', ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $username, $password, $ime, $prezime, $adresa, $oib, $iban);
    
    if ($stmt->execute()) {
        echo '<p style="color:green; text-align:center;">Uspješno registriran! Preusmjeravanje...</p>';
        echo '<script>setTimeout(function(){ window.location.href = "login.php"; }, 1500);</script>';
    } else {
        echo '<p style="color:red; text-align:center;">Greška: ' . $stmt->error . '</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/phpcss.css">
    <style>
        body { background-color: #1a1a1a; color: #ccc; font-family: Arial, sans-serif; margin: 0; }
        .navbar { background-color: #000; padding: 15px; border-bottom: 2px solid #e60000; margin-bottom: 20px; text-align: left; }
        .navbar a { color: #ff0000; text-decoration: none; margin-right: 20px; font-weight: bold; font-family: Arial; }
        
        .container { width: 300px; margin: 50px auto; padding: 20px; }
        h1 { color: #e60000; }
        input { width: 100%; padding: 10px; margin: 10px 0; background: #333; border: none; border-bottom: 2px solid #e60000; color: white; box-sizing: border-box; }
        
        /* Crveni gumb kao na loginu */
        .btn-crveni { background: #e60000; color: white; border: none; padding: 10px; width: 100%; cursor: pointer; margin-top: 10px; }
        .btn-crveni:hover { background: #cc0000; }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="../pocetnastranica.php">POCETNA</a>
        <a href="login.php">Login</a>
        <a href="register.php">Registracija</a>
    </nav>

    <div class="container">
        <h1>Registracija</h1>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="ime" placeholder="Ime" required>
            <input type="text" name="prezime" placeholder="Prezime" required>
            <input type="text" name="adresa" placeholder="Adresa" required>
            <input type="text" name="oib" placeholder="OIB" required>
            <input type="text" name="iban" placeholder="IBAN" required>
            <button type="submit" name="register" class="btn-crveni">Registriraj se</button>
        </form>
    </div>
</body>
</html>