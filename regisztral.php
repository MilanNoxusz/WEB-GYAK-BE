<?php
if (isset($_POST['csn']) && isset($_POST['un']) && isset($_POST['login']) && isset($_POST['password'])) {
    try {
       $dbh = new PDO('mysql:host=localhost;dbname=webgyakbea', 'webgyakbea', 'HYZ9ZM_OK3ZO0', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        $sqlSelect = "SELECT id FROM felhasznalok WHERE bejelentkezes = :login";
        $sth = $dbh->prepare($sqlSelect);
        $sth->execute(array(':login' => $_POST['login']));
        if ($sth->fetch(PDO::FETCH_ASSOC)) {
            echo "A felhasználónév már foglalt!";
        } else {
            $sqlInsert = "INSERT INTO felhasznalok (csaladi_nev, uto_nev, bejelentkezes, jelszo)
                          VALUES (:csn, :un, :login, sha1(:password))";
            $stmt = $dbh->prepare($sqlInsert);
            $stmt->execute(array(
                ':csn' => $_POST['csn'],
                ':un' => $_POST['un'],
                ':login' => $_POST['login'],
                ':password' => $_POST['password']
            ));

            if ($stmt->rowCount()) {
                echo "Sikeres regisztráció! Most már bejelentkezhetsz.";
            } else {
                echo "A regisztráció nem sikerült.";
            }
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