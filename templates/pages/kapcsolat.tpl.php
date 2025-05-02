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

<section>
    <h3>Üzenőfal</h3>
    <p>Itt hagyhatsz üzenetet az oldal tulajdonosának:</p>
    <form id="kapcsolatForm" method="post" action="kapcsolat.php">
        <label for="nev">Név:</label>
        <input type="text" id="nev" name="nev" value="<?= isset($_SESSION['csn']) ? htmlspecialchars($_SESSION['csn'] . ' ' . $_SESSION['un']) : '' ?>" <?= isset($_SESSION['csn']) ? 'readonly' : 'required' ?>>
        <br>
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" value="<?= isset($_SESSION['login']) ? htmlspecialchars($_SESSION['login']) : '' ?>" <?= isset($_SESSION['login']) ? 'readonly' : 'required' ?>>
        <br>
        <label for="uzenet">Üzenet:</label>
        <textarea id="uzenet" name="uzenet" rows="5" required></textarea>
        <br>
        <button type="submit">Küldés</button>
    </form>
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