<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUSICPEDIA</title>
    <link rel="stylesheet" href="CSS/izgledstranica.css">
    <a href="pocetnastranica.php" class="izbornik">POCETNA</a>
    <a href="izvori.php" class="izbornik">IZVORI</a>
    <a href="popiszanrova.php" class="izbornik">POPIS ZANROVA</a>
</head>
<body>

    <h1><b>MUSICPEDIA</b></h1>

    <h2>Kontaktirajte nas ovdje</h2>
    <form action="https://formspree.io/f/xojnkjvl" method="POST" class="kontakt-forma">
        <p>
            Ime:<br>
            <input type="text" name="ime" required>
        </p>

        <p>
            e-pošta:<br>
            <input type="email" name="email" required>
        </p>


        <p>
            Država:
            <select name="drzava">
                <option value="Hrvatska">Hrvatska</option>
                <option value="Njemačka">Njemačka</option>
                <option value="SAD">SAD</option>

                <option value="Bosna i Hercegovina">Bosna i Hercegovina</option>
                <option value="Srbija">Srbija</option>
                <option value="Slovenija">Slovenija</option>
            </select>
        </p>

        <p>
            Poruka:<br>
            <textarea name="poruka" rows="4" cols="30" required></textarea>
        </p>

        <button type="submit" class="gumb-posalji">Pošalji</button>
    </form>

    <hr>

</body>
</html>