<?php
session_start();

if (isset($_POST['login']) && isset($_POST['password'])) {
    try {
        // Kapcsolódás az adatbázishoz
        $dbh = new PDO('mysql:host=localhost;dbname=webgyakbea', 'felhasznalok', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        // Felhasználó keresése
        $sqlSelect = "SELECT id, csaladi_nev, uto_nev FROM felhasznalok
                      WHERE bejelentkezes = :login AND jelszo = sha1(:password)";
        $stmt = $dbh->prepare($sqlSelect);
        $stmt->execute(array(':login' => $_POST['login'], ':password' => $_POST['password']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Sikeres belépés
            $_SESSION['csn'] = $row['csaladi_nev'];
            $_SESSION['un'] = $row['uto_nev'];
            $_SESSION['login'] = $_POST['login'];
            header("Location: index.php");
        } else {
            echo "Hibás felhasználónév vagy jelszó!";
        }
    } catch (PDOException $e) {
        echo "Hiba történt: " . $e->getMessage();
    }
} else {
    echo "Hiányzó adatok! Kérlek, töltsd ki az összes mezőt.";
}
?>
<footer>
        <p>&copy; <?= date("Y") ?> <?= $lablec['ceg'] ?></p>
        <p>Készítette: <B>Sári Bence(OK3ZO0)</B> és <b>Muskó Milán(HYZ9ZM)</b></p>
        <p>Kapcsolat: info@utazasi-iroda.hu | Telefon: +36 1 234 5678</p>
    </footer>