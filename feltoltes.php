<?php
session_start();

if (!isset($_SESSION['login'])) {
    die("Csak bejelentkezett felhasználók tölthetnek fel képeket.");
}

// Konfiguráció
$target_dir = "images/";
$max_size = 2000000; // 2 MB
$allowed_types = ["image/jpeg", "image/png", "image/gif"];
$messages = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_FILES as $file) {
        if ($file['error'] === UPLOAD_ERR_NO_FILE) {
            $messages[] = "Nem töltöttél fel fájlt.";
        } elseif (!in_array($file['type'], $allowed_types)) {
            $messages[] = "Nem megfelelő fájltípus: " . $file['name'];
        } elseif ($file['error'] === UPLOAD_ERR_INI_SIZE || $file['error'] === UPLOAD_ERR_FORM_SIZE || $file['size'] > $max_size) {
            $messages[] = "Túl nagy fájl: " . $file['name'];
        } else {
            $target_file = $target_dir . strtolower(basename($file['name']));
            if (file_exists($target_file)) {
                $messages[] = "A fájl már létezik: " . $file['name'];
            } else {
                if (move_uploaded_file($file['tmp_name'], $target_file)) {
                    $messages[] = "Sikeresen feltöltve: " . $file['name'];
                } else {
                    $messages[] = "Hiba történt a fájl feltöltése során: " . $file['name'];
                }
            }
        }
    }

    // Tároljuk az üzeneteket a munkamenetben
    $_SESSION['feltoltes_uzenetek'] = $messages;

    // Visszairányítás a "Képek" oldalra
    header("Location: index.php?oldal=kepek");
    exit();
}
?>
