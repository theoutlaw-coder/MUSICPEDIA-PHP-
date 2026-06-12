<nav class="navbar">
    <a href="../pocetnastranica.php">POCETNA</a>
    
    <a href="ispis.php">Popis koncerata</a>
    <a href="narudzbe.php">Narudžbe</a>

    <?php 
   
    ?>
    <?php if (!isset($_SESSION['uloga']) || $_SESSION['uloga'] !== 'administrator'): ?>
        <a href="kosarica.php">Košarica</a>
    <?php endif; ?>

    <?php 
    ?>
    <?php if (isset($_SESSION['uloga']) && $_SESSION['uloga'] === 'administrator'): ?>
        <a href="unos.php">Dodaj koncert</a>
        <a href="racuni.php">Računi</a>
    <?php endif; ?>

    <a href="logout.php">Logout</a>
</nav>
