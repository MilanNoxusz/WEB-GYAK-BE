<section>
    <h2>Üzenetek</h2>
    <?php
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=webgyakbea', 'webgyakbea', 'HYZ9ZM_OK3ZO0', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        $sqlSelect = "SELECT nev, uzenet, datum FROM uzenetek ORDER BY datum DESC";
        $stmt = $dbh->query($sqlSelect);

        if ($stmt->rowCount() > 0): ?>
            <ul class="message-list">
                <?php foreach ($stmt as $row): ?>
                    <li class="message-item">
                        <p><strong><?= htmlspecialchars($row['nev'] ?: 'Vendég') ?>:</strong></p>
                        <p><?= htmlspecialchars($row['uzenet']) ?></p>
                        <p class="message-date"><em><?= htmlspecialchars($row['datum']) ?></em></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nincs megjeleníthető üzenet.</p>
        <?php endif;
    } catch (PDOException $e) {
        echo "<p>Hiba történt az üzenetek betöltése során: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
    ?>
</section>