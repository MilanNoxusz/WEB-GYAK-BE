<!-- filepath: d:\WebEloadasBeadando\WEB-GYAK-BE\kapcsolat.php -->
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nev = trim($_POST['nev']);
    $email = trim($_POST['email']);
    $uzenet = trim($_POST['uzenet']);

    if (empty($nev) || empty($email) || empty($uzenet)) {
        $_SESSION['uzenet'] = "Minden mezőt ki kell tölteni!";
        header("Location: index.php?oldal=kapcsolat");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['uzenet'] = "Érvénytelen e-mail cím!";
        header("Location: index.php?oldal=kapcsolat");
        exit();
    }

    try {
        $dbh = new PDO('mysql:host=localhost;dbname=webgyakbea', 'webgyakbea', 'HYZ9ZM_OK3ZO0', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        $sqlInsert = "INSERT INTO uzenetek (nev, email, uzenet) VALUES (:nev, :email, :uzenet)";
        $stmt = $dbh->prepare($sqlInsert);
        $stmt->execute(array(':nev' => $nev, ':email' => $email, ':uzenet' => $uzenet));

        if ($stmt->rowCount()) {
            $_SESSION['uzenet'] = "Az üzenetet sikeresen elküldve, megtekintheti az Üzenetek menüben, amennyiben regisztrált.";
        } else {
            $_SESSION['uzenet'] = "Hiba történt az üzenet küldése során.";
        }
    } catch (PDOException $e) {
        $_SESSION['uzenet'] = "Hiba történt: " . $e->getMessage();
    }

    header("Location: index.php?oldal=kapcsolat");
    exit();
}
?>