# MUSICPEDIA ( sustav za kupnju karata(kupac) i za upravljanje koncertima(administrator))
Napomena : HTML nema svoju dadoteku jer kad sam radio za HTML projekt sam ju zaboravio promjeniti, a sada da to napravim morao bi promjeniti sve kodove( ima ih oko 50).
## ZA TESTIRANJE
(lozinke i emailovi koriste se samo za stranicu i koristite ih u login.php( kada se pritisne login na navbaru) 
Lozinka za admin:  Admin:lukas.gavran17@gmail.com  lozinka : tock
Lozinka za korisnik( napraviti sam novog korisnika ili koristi već kojeg sam ja napravio) ( korisnik: lukas.gavran15@gmail.com lozinka: tocker 
## Opis projekta
Projek je web aplikacija koja nam radi simulaciju prodaje ulaznica za koncerte. Korisnici u sustavu imaju mogućnost pregleda koncerata, upravljanja košaricom, kupnju ulaznica, pregled narudžbi i ispis računa. Administrator ima potpuni uvid u sustav, on može dodavati nove koncerte, brisati, mjenati, administrator može pregladati narudžbe od svih korisnika i može pregledati sve račune. 


## Glavne funkcionalnosti u aplikaciji
- Autentikacija: Sigurna registracija i prijava(login) za korisnike i administratore gdje su lozinke hashirane. 
- Kontrola pristupa:  U vrijeme prijave(login) sustav provjerava u bazi da li je korisnik kupac ili administrator, i onda ovisno jel je administrator ili korisnik drukčije mu se prikazuje stranica.
-Crud operacije: Potpuno upravljne koncertima za administratore (Create, Read, Update, Delete).
- Nadzorna ploća(dashboard): Središnja stranica koja je prilagođena korisniku ovisono o njihovoj ulozi. 
- Relacijska baza podataka: Povezani entiteti(Korisnici - Narudžbe) putem stranih kljuceva(foreign key)

## Tehničke specifikacije
- Backend: PHP
- Baza podataka: MySQL
- Sigurnost:  Koristio sam password_hash() i password_verify() za lozinke, i prepared statements za zaštitu SQLa. 
- Dizajn: Koristio sam PHP, HTML i CSS naredbe. 

## Upute za pokretanje MUSICPEDIJE
1. Kloniranje reprezotorija u htdocks mapu(ako se koristi XAMPP, a ako ne prvo ga instalirati)
2. U XAMPP Control Panel( kliknuti na start kod Apache i MYSQL )
3. Kod MySQL dijela pritisnuti na Admin
4. Otvorit će se phpMyAdmin.
5. Unutar njega kreirati novu bazu(new), pod nazivom musicpedia_db 
6. Pritisnite na import i izaberite priloženu .sql datoteku u bazu podataka. 
7. U PHP folderu rada otvoriti spoj.php datoteku i provjerite jesu li podaci za spanjane na bazu točni(host,user,pass,db_name).
8. Ako je sve gore navedno dobro napravljeno jednostavno otvorite aplikaciju na linku http://localhost/seminarski/
9. Ako se hoće samo pregledavati žanrove, bendove, njihove informacije, nemojte pritisnuti na login/req već samo navigirajte kroz  POCETNA, IZVORI, POPIS ZANROVA, KONTAKTI(ako ste i ulogirani u sustav i ošli u aplikacijski dio sustava za kupovanje/upravljanje kartama sa tipkom POCETNA možete se vratiti na statični dio stranice).
10. Za više pitanja koristite KONTAKTI( povezano je sa mojim emailom pa Vam mogu natrag odgovoriti)
11. Ako glavnu stranicu iz nekog razloga se ne prikazuje ovdje ću još jednom opisati kako i gdje staviti sve filove. 
1. lokalni disk C
2. datoteka(xampp) 
3. htdocks
4. (kreiriati novu mapu ovdje(seminarski) i u tu mapu sve datoteke sa github exportati. 

