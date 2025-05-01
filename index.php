<?php
session_start();
include('./includes/config.inc.php'); 

$keres = isset($_GET['oldal']) && isset($oldalak[$_GET['oldal']]) ? $oldalak[$_GET['oldal']] : $oldalak['/'];

if (file_exists('./logicals/' . $keres['fajl'] . '.php')) {
    include("./logicals/{$keres['fajl']}.php");
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/stilus.css">
    <title><?= $ablakcim['cim'] ?></title>
</head>
<body>
    <header>
        <h1><?= $fejlec['cim'] ?></h1>
        <?php if (isset($fejlec['motto'])): ?>
            <h2><?= $fejlec['motto'] ?></h2>
        <?php endif; ?>
        <?php if(isset($_SESSION['login'])) { ?>Bejlentkezve: <strong><?= $_SESSION['csn']." ".$_SESSION['un']." (".$_SESSION['login'].")" ?></strong><?php } ?>
    </header>
    <nav>
        <ul>
            <?php foreach ($oldalak as $url => $oldal): ?>
                <?php if ((!isset($_SESSION['login']) && $oldal['menun'][0]) || (isset($_SESSION['login']) && $oldal['menun'][1])): ?>
                    <li<?= ($keres['fajl'] === $oldal['fajl']) ? ' class="active"' : '' ?>>
                        <a href="?oldal=<?= $url ?>"><?= $oldal['szoveg'] ?></a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </nav>
    <main>
        <div id="content">
            <?php include("./templates/pages/{$keres['fajl']}.tpl.php"); ?>
        </div>
    </main>
    <footer>
        <p>&copy; <?= date("Y") ?> <?= $lablec['ceg'] ?></p>
        <p>Készítette: <B>Sári Bence(OK3ZO0)</B> és <b>Muskó Milán(HYZ9ZM)</b></p>
        <p>Kapcsolat: info@utazasi-iroda.hu | Telefon: +36 1 234 5678</p>
    </footer>
</body>
</html>
