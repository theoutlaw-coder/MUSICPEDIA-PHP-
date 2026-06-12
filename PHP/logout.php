<?php
session_start();
session_destroy();
header("Location: ../pocetnastranica.php");
exit;
?>