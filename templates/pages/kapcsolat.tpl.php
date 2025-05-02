<section>
    <h2>Kapcsolatfelvétel</h2>
    <p>
        Ha bármilyen kérdésed van, vagy segítségre van szükséged az utazás megtervezésében, ne habozz kapcsolatba lépni velünk!
    </p>
    <p>
        <strong>Email:</strong> info@utazasi-iroda.hu<br>
        <strong>Telefon:</strong> +36 1 234 5678<br>
        <strong>Cím:</strong> 1051 Budapest, Fő utca 1.
    </p>
</section>

<?php if (isset($_SESSION['uzenet'])): ?>
    <p style="color: green; font-weight: bold;"><?= htmlspecialchars($_SESSION['uzenet']) ?></p>
    <?php unset($_SESSION['uzenet']); // Üzenet törlése a munkamenetből ?>
<?php endif; ?>

<section>
    <h3>Üzenőfal</h3>
    <p>Itt hagyhatsz üzenetet az oldal tulajdonosának:</p>
    <form id="kapcsolatForm" method="post" action="kapcsolat.php">
        <label for="nev">Név:</label>
        <input type="text" id="nev" name="nev" value="<?= isset($_SESSION['login']) ? htmlspecialchars($_SESSION['login']) : 'Vendég' ?>" readonly>
        <br>
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" value="<?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : '' ?>" <?= isset($_SESSION['email']) ? 'readonly' : 'required' ?>>
        <br>
        <label for="uzenet">Üzenet:</label>
        <textarea id="uzenet" name="uzenet" rows="5" required></textarea>
        <br>
        <button type="submit">Küldés</button>
    </form>
</section>

<section>
    <h3>Korábbi üzenetek</h3>
    <?php
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=webgyakbea', 'webgyakbea', 'HYZ9ZM_OK3ZO0', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        $sqlSelect = "SELECT nev, uzenet, datum FROM uzenetek ORDER BY datum DESC";
        foreach ($dbh->query($sqlSelect) as $row): ?>
            <div class="comment">
                <p><strong><?= htmlspecialchars($row['nev']) ?>:</strong> <?= htmlspecialchars($row['uzenet']) ?></p>
                <p><em><?= htmlspecialchars($row['datum']) ?></em></p>
            </div>
        <?php endforeach;
    } catch (PDOException $e) {
        echo "<p>Hiba történt az üzenetek betöltése során: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
    ?>
</section>

<script>
    document.getElementById('kapcsolatForm').addEventListener('submit', function (e) {
        const nev = document.getElementById('nev').value.trim();
        const email = document.getElementById('email').value.trim();
        const uzenet = document.getElementById('uzenet').value.trim();

        if (!nev || !email || !uzenet) {
            e.preventDefault();
            alert('Kérlek, töltsd ki az összes mezőt!');
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            e.preventDefault();
            alert('Kérlek, adj meg egy érvényes e-mail címet!');
        }
    });
</script>