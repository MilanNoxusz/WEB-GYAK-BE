<!-- filepath: d:\WebEloadasBeadando\WEB-GYAK-BE\kapcsolat.php -->
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nev = trim($_POST['nev']);
    $email = trim($_POST['email']);
    $uzenet = trim($_POST['uzenet']);

    if (empty($nev) || empty($email) || empty($uzenet)) {
        die("Minden mezőt ki kell tölteni!");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Érvénytelen e-mail cím!");
    }

    try {
        $dbh = new PDO('mysql:host=localhost;dbname=webgyakbea', 'webgyakbea', 'HYZ9ZM_OK3ZO0', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        $sqlInsert = "INSERT INTO uzenetek (nev, email, uzenet) VALUES (:nev, :email, :uzenet)";
        $stmt = $dbh->prepare($sqlInsert);
        $stmt->execute(array(':nev' => $nev, ':email' => $email, ':uzenet' => $uzenet));

        echo "Az üzeneted sikeresen elküldve!";
    } catch (PDOException $e) {
        echo "Hiba történt: " . $e->getMessage();
    }
} else {
    echo "Hibás kérés!";
}
?>