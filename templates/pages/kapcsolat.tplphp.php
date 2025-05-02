<!-- filepath: d:\WebEloadasBeadando\WEB-GYAK-BE\templates\pages\kapcsolat.tpl.php -->
<h2>Kapcsolatfelvétel</h2>
<form id="kapcsolatForm" method="post" action="kapcsolat.php">
    <label for="nev">Név:</label>
    <input type="text" id="nev" name="nev" required>
    <br>
    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="uzenet">Üzenet:</label>
    <textarea id="uzenet" name="uzenet" rows="5" required></textarea>
    <br>
    <button type="submit">Küldés</button>
</form>
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