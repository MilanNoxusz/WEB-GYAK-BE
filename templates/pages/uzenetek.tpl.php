<!-- filepath: d:\WebEloadasBeadando\WEB-GYAK-BE\templates\pages\uzenetek.tpl.php -->
<h2>Beérkezett üzenetek</h2>
<table>
    <thead>
        <tr>
            <th>Név</th>
            <th>E-mail</th>
            <th>Üzenet</th>
            <th>Dátum</th>
        </tr>
    </thead>
    <tbody>
        <?php
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=webgyakea', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

            $sqlSelect = "SELECT nev, email, uzenet, datum FROM uzenetek ORDER BY datum DESC";
            foreach ($dbh->query($sqlSelect) as $row) {
                echo "<tr>
                        <td>{$row['nev']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['uzenet']}</td>
                        <td>{$row['datum']}</td>
                      </tr>";
            }
        } catch (PDOException $e) {
            echo "<tr><td colspan='4'>Hiba történt: " . $e->getMessage() . "</td></tr>";
        }
        ?>
    </tbody>
</table>