-- Tablica za korisnike (s podrškom za hashirane lozinke)
CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Tablica za Musicpedia sadržaj
CREATE TABLE glazba (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    izvodjac VARCHAR(100) NOT NULL,
    zanr VARCHAR(50) NOT NULL,
    biografija TEXT NOT NULL,
    korisnik_id INT(11) NOT NULL,
    FOREIGN KEY (korisnik_id) REFERENCES users(id)
);