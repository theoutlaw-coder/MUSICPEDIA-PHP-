<?php
session_start();
include "spoj.php";
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $username = $_SESSION['username'];
    mysqli_query($spoj, "DELETE FROM kosarica WHERE id = $id AND username = '$username'");
}
header("Location: kosarica.php");
exit();
?>