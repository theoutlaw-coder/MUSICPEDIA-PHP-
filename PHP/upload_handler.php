<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = 'uploads/'; // Directory to save uploaded files
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true); // If directory doesn't exist, create it
    }
    
    $uploadedFile = $uploadDir . basename($_FILES['file']['name']);
    $uploadOk = true;
    $fileType = strtolower(pathinfo($uploadedFile, PATHINFO_EXTENSION));
    
    
    // Check if file already exists
    if (file_exists($uploadedFile)) {
        echo 'Sorry, file already exists.';
        $uploadOk = false;
    }
    
    // Check file size
    if ($_FILES['file']['size'] > 500000) {
        echo 'Sorry, your file is too large.';
        $uploadOk = false;
    }
    
    // Allow only certain file types
    $allowedFileTypes = ['txt', 'pdf', 'docx'];
    if (!in_array($fileType, $allowedFileTypes)) {
        echo 'Sorry, only TXT, PDF, and DOCX files are allowed.';
        $uploadOk = false;
    }
    
    // Check if uploadOk is true
    if ($uploadOk) {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFile)) {
            echo 'The file ' . basename($_FILES['file']['name']) . ' has been uploaded.';
        } else {
            echo 'Sorry, there was an error uploading your file.';
        }
    } else {
        echo 'Sorry, your file was not uploaded.';
    }
}
?>
