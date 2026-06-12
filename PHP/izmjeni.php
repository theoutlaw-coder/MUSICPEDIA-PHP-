<?php
session_start();
include "spoj.php";
if (!isset($_GET['id'])) die("Nema ID-a.");
$id = (int)$_GET['id'];

if (isset($_POST["spremi"])) {
    $stmt = $spoj->prepare("UPDATE koncerti SET bend=?, datum_koncerta=?, vrijeme=?, mjesto=?, cijena=? WHERE id=?");
    $stmt->bind_param("ssssdi", $_POST["bend"], $_POST["datum"], $_POST["vrijeme"], $_POST["mjesto"], $_POST["cijena"], $id);
    $stmt->execute();
    header("Location: ispis.php");
    exit();
}

$stmt = $spoj->prepare("SELECT * FROM koncerti WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$koncert = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="hr">
<head><link rel="stylesheet" href="../CSS/phpcss.css"></head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h1>Uredi koncert</h1>
        <form method="post">
            <input type="text" name="bend" value="<?php echo htmlspecialchars($koncert['bend']); ?>" required>
            <input type="text" name="datum" value="<?php echo htmlspecialchars($koncert['datum_koncerta']); ?>">
            <input type="text" name="vrijeme" value="<?php echo htmlspecialchars($koncert['vrijeme']); ?>">
            <input type="text" name="mjesto" value="<?php echo htmlspecialchars($koncert['mjesto']); ?>">
            <input type="number" step="0.01" name="cijena" value="<?php echo htmlspecialchars($koncert['cijena']); ?>">
            <button type="submit" name="spremi" class="btn-crud">Spremi</button>
        </form>
    </div>
</body>
</html>