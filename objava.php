<?php
session_start();

// Sigurnosna provjera: Ako korisnik nije prijavljen kao profesor, izbaci ga!
if (!isset($_SESSION['korisnik']) || $_SESSION['uloga'] !== 'profesor') {
    header("Location: login.php");
    exit;
}

$poruka = "";

// Logika za primanje podataka iz forme za objavu (CRUD: Create dio)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Filtriranje i čišćenje unosa (Sigurnosni standardi)
    $izvodjac = filter_input(INPUT_POST, 'izvodjac', FILTER_SANITIZE_SPECIAL_CHARS);
    $zanr = filter_input(INPUT_POST, 'zanr', FILTER_SANITIZE_SPECIAL_CHARS);
    $biografija = filter_input(INPUT_POST, 'biografija', FILTER_SANITIZE_SPECIAL_CHARS);

    if (!empty($izvodjac) && !empty($zanr) && !empty($biografija)) {
        // Budući da nemamo bazu, ovdje ispisujemo poruku uspjeha na ekranu
        $poruka = "Uspješno spremljeno! Izvođač <strong>$izvodjac</strong> je dodan u žanr <strong>$zanr</strong>.";
    } else {
        $poruka = "Sva polja u formi su obavezna!";
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Objava - MUSICPEDIA</title>
    <link rel="stylesheet" href="CSS/izgledstranica.css">
</head>
<body>

    <div style="margin-bottom: 20px;">
        <a href="pocetnastranica.html" class="izbornik">POCETNA</a>
        <a href="popiszanrova.html" class="izbornik">POPIS ZANROVA</a>
        <a href="logout.php" class="izbornik" style="color: red;">ODJAVA (<?php echo $_SESSION['korisnik']; ?>)</a>
    </div>

    <h1><b>MUSICPEDIA</b></h1>
    <h2>Unos Novog Izvođača / Albuma</h2>

    <div style="max-width: 600px; margin: 30px auto; background: #111; padding: 30px; color: #fff; border-radius: 8px; border: 1px solid #333; font-family: sans-serif; text-align: left;">
        
        <?php if(!empty($poruka)): ?>
            <div style="padding: 12px; margin-bottom: 20px; border-radius: 4px; background: #2e7d32; color: #fff;">
                <?php echo $poruka; ?>
            </div>
        <?php endif; ?>

        <form action="objava.php" method="POST">
            <label style="display:block; margin-bottom: 5px; font-weight:bold;">Naziv Izvođača / Benda:</label>
            <input type="text" name="izvodjac" required style="width:100%; padding:10px; margin-bottom:15px; background:#222; color:#fff; border:1px solid #444; border-radius:4px; box-sizing: border-box;">

            <label style="display:block; margin-bottom: 5px; font-weight:bold;">Odaberi Žanr:</label>
            <select name="zanr" required style="width:100%; padding:10px; margin-bottom:15px; background:#222; color:#fff; border:1px solid #444; border-radius:4px; box-sizing: border-box;">
                <option value="Pop">Pop</option>
                <option value="Rock">Rock</option>
                <option value="Country">Country</option>
                <option value="R&B and Soul">R&B and Soul</option>
                <option value="Hip-Hop">Hip-Hop</option>
                <option value="Classical">Classical</option>
                <option value="Jazz">Jazz</option>
            </select>

            <label style="display:block; margin-bottom: 5px; font-weight:bold;">Biografija / Opis:</label>
            <textarea name="biografija" rows="5" required style="width:100%; padding:10px; margin-bottom:25px; background:#222; color:#fff; border:1px solid #444; border-radius:4px; box-sizing: border-box; resize: vertical;"></textarea>

            <input type="submit" value="Objavi na Musicpedia" style="width:100%; padding:12px; background: #fff; color: #000; border: none; cursor: pointer; font-weight: bold; border-radius:4px;">
        </form>
    </div>

</body>
</html>