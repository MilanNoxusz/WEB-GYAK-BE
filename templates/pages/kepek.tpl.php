<h2>Képgaléria</h2>
<div class="gallery">
    <div class="gallery-item"><img class="gallery-img" src="images/kep1.jpg" alt="Kép 1"></div>
    <div class="gallery-item"><img class="gallery-img" src="images/kep2.jpg" alt="Kép 2"></div>
    <div class="gallery-item"><img class="gallery-img" src="images/kep3.jpg" alt="Kép 3"></div>
    <div class="gallery-item"><img class="gallery-img" src="images/kep4.jpg" alt="Kép 4"></div>
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