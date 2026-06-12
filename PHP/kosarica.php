<?php
session_start();
include "spoj.php";

if(isset($_POST['kupi'])) {
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
    
    $res = mysqli_query($spoj, "SELECT c.bend, c.cijena, c.mjesto, c.vrijeme, k.kolicina FROM kosarica k JOIN koncerti c ON k.koncert_id = c.id WHERE k.username = '$username'");
    $popis = [];
    $total_za_bazu = 0;

    while($row = mysqli_fetch_assoc($res)) {
        $subtotal = $row['cijena'] * $row['kolicina'];
        $total_za_bazu += $subtotal;
        $popis[] = $row['bend'] . "|" . $row['kolicina'] . "|" . $row['cijena'] . "|" . $subtotal . "|" . $row['mjesto'] . "|" . $row['vrijeme'];
    }
    
    $opis_narudzbe = implode(";", $popis);
    mysqli_query($spoj, "INSERT INTO narudzbe (user_id, username, ukupna_cijena, opis) VALUES ('$user_id', '$username', '$total_za_bazu', '$opis_narudzbe')");
    $narudzba_id = mysqli_insert_id($spoj);
    mysqli_query($spoj, "DELETE FROM kosarica WHERE username = '$username'");
    
    header("Location: racun.php?id=$narudzba_id");
    exit();
}

if(isset($_POST['isprazni'])) {
    mysqli_query($spoj, "DELETE FROM kosarica WHERE username = '{$_SESSION['username']}'");
    header("Location: kosarica.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="hr">
<head><link rel="stylesheet" href="../CSS/phpcss.css"></head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h1>Košarica</h1>
        <?php
        $result = mysqli_query($spoj, "SELECT k.id as kosarica_id, k.kolicina, c.bend, c.cijena, c.mjesto, c.vrijeme FROM kosarica k JOIN koncerti c ON k.koncert_id = c.id WHERE k.username = '{$_SESSION['username']}'");
        $total_prikaz = 0;
        if(mysqli_num_rows($result) > 0) {
            echo '<form method="post"><button type="submit" name="isprazni" class="btn-crud" style="background:red;">Isprazni</button></form>
                  <table class="table">
                  <tr><th>Bend</th><th>Mjesto</th><th>Vrijeme</th><th>Količina</th><th>Ukupno</th><th>Obriši artikl</th></tr>';
            while($row = mysqli_fetch_assoc($result)) {
                $subtotal = $row['cijena'] * $row['kolicina'];
                echo "<tr>
                        <td>{$row['bend']}</td>
                        <td>{$row['mjesto']}</td>
                        <td>{$row['vrijeme']}</td>
                        <td>
                            <form method='post' action='azuriraj_kosaricu.php' style='display:inline;'>
                                <input type='hidden' name='id' value='{$row['kosarica_id']}'>
                                <input type='number' name='kolicina' value='{$row['kolicina']}' min='1' onchange='this.form.submit()' style='width:60px;'>
                            </form>
                        </td>
                        <td>{$subtotal} €</td>
                        <td><a href='obrisi_iz_kosarice.php?id={$row['kosarica_id']}'>Obriši artikl</a></td>
                      </tr>";
                $total_prikaz += $subtotal;
            }
            echo "</table><h3>Ukupno: $total_prikaz €</h3><form method='post'><button type='submit' name='kupi' class='btn-plavi'>Kupi</button></form>";
        } else { echo '<p>Košarica je prazna.</p>'; }
        ?>
    </div>
</body>
</html>