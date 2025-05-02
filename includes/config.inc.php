<?php
// Az oldal címe és mottója
$ablakcim = array(
    'cim' => 'Utazási Iroda',
    'motto' => 'Fedezd fel a világot velünk!'
);

// Fejléc adatok
$fejlec = array(
    'kepforras' => 'logo.png', // A logó képfájl neve
    'kepalt' => 'Utazási Iroda logó',
    'cim' => 'Utazási Iroda',
    'motto' => 'Fedezd fel a világot velünk!'
);

// Lábléc adatok
$lablec = array(
    'copyright' => 'Copyright ' . date("Y") . '.',
    'ceg' => 'Utazási Iroda Kft.'
);

// Menüpontok
$oldalak = array(
    '/' => array('fajl' => 'cimlap', 'szoveg' => 'Főoldal', 'menun' => array(1, 1)),
    'kepek' => array('fajl' => 'kepek', 'szoveg' => 'Képek', 'menun' => array(1, 1)),
    'kapcsolat' => array('fajl' => 'kapcsolat', 'szoveg' => 'Kapcsolat', 'menun' => array(1, 1)),
    'uzenetek' => array('fajl' => 'uzenetek', 'szoveg' => 'Üzenetek', 'menun' => array(0, 1)),
    'belepes' => array('fajl' => 'belepes', 'szoveg' => 'Belépés', 'menun' => array(1, 0)),
    'regisztral' => array('fajl' => 'regisztral', 'szoveg' => '', 'menun' => array(1, 0))
);

// Hibaoldal
$hiba_oldal = array(
    'fajl' => '404',
    'szoveg' => 'A keresett oldal nem található!'
);
?>