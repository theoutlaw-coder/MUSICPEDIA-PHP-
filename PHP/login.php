<?php
session_start();
include "spoj.php";

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; 

    $stmt = $spoj->prepare("SELECT id, username, password, uloga FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['uloga'] = $row['uloga']; 
            $_SESSION['loggedin'] = true;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Pogrešna lozinka.";
        }
    } else {
        $error = "Korisnik ne postoji.";
    }
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/phpcss.css">
    <style>
        /* Isto kao na registraciji */
        .navbar { background-color: #000; padding: 15px; border-bottom: 2px solid #e60000; margin-bottom: 20px; }
        .navbar a { color: #ff0000; text-decoration: none; margin-right: 20px; font-weight: bold; font-family: Arial; }
        
        body { background-color: #1a1a1a; color: #ccc; font-family: Arial, sans-serif; margin: 0; }
        .container { width: 300px; margin: 50px auto; padding: 20px; }
        h1 { color: #e60000; }
        input { width: 100%; padding: 10px; margin: 10px 0; background: #333; border: none; border-bottom: 2px solid #e60000; color: white; box-sizing: border-box; }
        .btn-plavi { background: #e60000; color: white; border: none; padding: 10px; width: 100%; cursor: pointer; margin-top: 10px; }
        .btn-plavi:hover { background: #cc0000; }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="../pocetnastranica.php">POCETNA</a>
        <a href="login.php">Login</a>
        <a href="register.php">Registracija</a>
    </nav>

    <div class="container">
        <h1>Login</h1>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login" class="btn-plavi">Prijavi se</button>
        </form>
        <p style="margin-top: 15px;">Ako nemaš račun, <a href="register.php" style="color:#e60000;">Registriraj se</a></p>
    </div>
</body>
</html>