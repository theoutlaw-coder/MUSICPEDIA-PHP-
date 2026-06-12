<?php
session_start();
include "spoj.php";
if(isset($_POST['kolicina']) && isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    $kolicina = (int)$_POST['kolicina'];
    if($kolicina > 0) {
        mysqli_query($spoj, "UPDATE kosarica SET kolicina = $kolicina WHERE id = $id");
    }
}
header("Location: kosarica.php");
?>