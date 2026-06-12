<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = 'uploads/'; // Direktorij za spremanje uploadanih datoteka
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Ako direktorij ne postoji, stvori ga
    }
    $uploadOk = true;
    // Iteriraj kroz svaku uploadiranu datoteku
    foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
        $uploadedFile = $uploadDir . basename($_FILES['files']['name'][$key]);
        $fileType = strtolower(pathinfo($uploadedFile, PATHINFO_EXTENSION));
        
        // Provjeri je li datoteka vec postoji
        if (file_exists($uploadedFile)) {
            echo 'Sorry, file already exists.';
            $uploadOk = false;
        }
        // Provjeri velicinu datoteke
        if ($_FILES['files']['size'][$key] > 500000) {
            echo 'Sorry, your file is too large.';
            $uploadOk = false;
        }
        // Dopusti samo odredene vrste datoteka
        $allowedFileTypes = ['txt', 'pdf', 'docx'];
        if (!in_array($fileType, $allowedFileTypes)) {
            echo 'Sorry, only TXT, PDF, and DOCX files are allowed.';
            $uploadOk = false;
        }
        // Provjeri je li uploadOk oznacen kao true prije svakog pokušaja uploada
        if ($uploadOk) {
            if (move_uploaded_file($_FILES['files']['tmp_name'][$key], $uploadedFile)) {
                echo 'The file ' . basename($_FILES['files']['name'][$key]) . ' has been uploaded.<br>';
            } else {
                echo 'Sorry, there was an error uploading your file.<br>';
            }
        } else {
            echo 'Sorry, your file was not uploaded.<br>';
        }
    }
}
?>
