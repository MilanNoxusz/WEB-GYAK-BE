<?php
include('./includes/config.inc.php');


$conn = new mysqli('localhost', 'root', '', 'Adatok');
if ($conn->connect_error) {
    die('Kapcsolódási hiba: ' . $conn->connect_error);
}

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