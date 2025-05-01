<?php
include('./includes/config.inc.php');

$dbh = new PDO('mysql:host=localhost;dbname=webgyakbea', 'webgyakbea', 'HYZ9ZM_OK3ZO0',
                            array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csn = $_POST['csn'];
    $un = $_POST['un'];
    $login = $_POST['login'];
    $password = sha1($_POST['password']);

    $stmt = $conn->prepare('INSERT INTO felhasznalok (csaladi_nev, uto_nev, bejelentkezes, jelszo) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssss', $csn, $un, $login, $password);

    if ($stmt->execute()) {
        echo 'Sikeres regisztráció! Most már bejelentkezhet.';
    } else {
        echo 'Hiba történt a regisztráció során.';
    }
}
?>
<footer>
        <p>&copy; <?= date("Y") ?> <?= $lablec['ceg'] ?></p>
        <p>Készítette: <B>Sári Bence(OK3ZO0)</B> és <b>Muskó Milán(HYZ9ZM)</b></p>
        <p>Kapcsolat: info@utazasi-iroda.hu | Telefon: +36 1 234 5678</p>
    </footer>