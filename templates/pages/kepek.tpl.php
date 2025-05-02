<h2>Képgaléria</h2>

<?php if (isset($_SESSION['feltoltes_uzenetek'])): ?>
    <ul>
        <?php foreach ($_SESSION['feltoltes_uzenetek'] as $uzenet): ?>
            <li><?= htmlspecialchars($uzenet) ?></li>
        <?php endforeach; ?>
    </ul>
    <?php unset($_SESSION['feltoltes_uzenetek']); // Üzenetek törlése a munkamenetből ?>
<?php endif; ?>

<div class="gallery">
    <?php
    $kepek = glob("images/*.{jpg,jpeg,png,gif}", GLOB_BRACE);
    foreach ($kepek as $kep): ?>
        <div class="gallery-item">
            <img class="gallery-img" src="<?= htmlspecialchars($kep) ?>" alt="Kép">
        </div>
    <?php endforeach; ?>
</div>

<?php if (isset($_SESSION['login'])): ?>
    <h3>Új kép feltöltése</h3>
    <form action="feltoltes.php" method="post" enctype="multipart/form-data">
        <label for="file">Válassz egy képet:</label>
        <input type="file" name="file" id="file" accept="image/*" required>
        <button type="submit">Feltöltés</button>
    </form>
<?php else: ?>
    <p>Csak bejelentkezett felhasználók tölthetnek fel képeket.</p>
<?php endif; ?>