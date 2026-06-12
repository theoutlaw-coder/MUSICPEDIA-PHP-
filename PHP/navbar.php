<nav class="navbar">
    <a href="pocetna.php">POCETNA</a>
    <a href="ispis.php">Popis koncerata</a>
    <a href="narudzbe.php">Narudžbe</a>
    <a href="kosarica.php">Košarica</a>
    
    <?php if(isset($_SESSION['uloga']) && $_SESSION['uloga'] == 'administrator'): ?>
        <a href="unos.php">Dodaj koncert</a>
        <a href="racuni.php">Računi</a>
    <?php endif; ?>
    
    <a href="logout.php">Logout</a>
</nav>