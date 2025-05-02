<?php
session_start();

if (!isset($_SESSION['login'])) {
    die("Csak bejelentkezett felhasználók tölthetnek fel képeket.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Ellenőrizd, hogy a fájl kép-e
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check === false) {
        die("A fájl nem kép.");
    }

    // Ellenőrizd a fájlméretet (max. 2 MB)
    if ($_FILES["file"]["size"] > 2000000) {
        die("A fájl túl nagy (max. 2 MB).");
    }

    // Csak bizonyos fájltípusok engedélyezése
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        die("Csak JPG, JPEG, PNG és GIF fájlok engedélyezettek.");
    }

    // Fájl feltöltése
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "A kép sikeresen feltöltve.";
    } else {
        echo "Hiba történt a feltöltés során.";
    }
}
?>