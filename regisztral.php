<?php
if (isset($_POST['csn']) && isset($_POST['un']) && isset($_POST['login']) && isset($_POST['password'])) {
    try {
        // Kapcsolódás az adatbázishoz
        $dbh = new PDO('local:3306;dbname=webgyakbea', 'webgyakbea', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        // Adatok beszúrása
        $sqlInsert = "INSERT INTO felhasznalok (csaladi_nev, uto_nev, bejelentkezes, jelszo)
                      VALUES (:csn, :un, :login, sha1(:password))";
        $stmt = $dbh->prepare($sqlInsert);
        $stmt->execute(array(
            ':csn' => $_POST['csn'],
            ':un' => $_POST['un'],
            ':login' => $_POST['login'],
            ':password' => $_POST['password']
        ));

        // Sikeres regisztráció
        echo "Sikeres regisztráció! Most már bejelentkezhetsz.";
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