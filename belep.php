<?php
session_start();
include('./includes/config.inc.php');

$conn = new mysqli('localhost', 'root', '', 'Adatok');
if ($conn->connect_error) {
    die('Kapcsolódási hiba: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = sha1($_POST['password']);

    $stmt = $conn->prepare('SELECT * FROM felhasznalok WHERE bejelentkezes = ? AND jelszo = ?');
    $stmt->bind_param('ss', $login, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION['login'] = $user['bejelentkezes'];
        $_SESSION['csn'] = $user['csaladi_nev'];
        $_SESSION['un'] = $user['uto_nev'];
        header('Location: index.php');
    } else {
        echo 'Hibás felhasználónév vagy jelszó!';
    }
}
?>
<footer>
        <p>&copy; <?= date("Y") ?> <?= $lablec['ceg'] ?></p>
        <p>Készítette: <B>Sári Bence(OK3ZO0)</B> és <b>Muskó Milán(HYZ9ZM)</b></p>
        <p>Kapcsolat: info@utazasi-iroda.hu | Telefon: +36 1 234 5678</p>
    </footer>