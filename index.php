<?php
  require_once __DIR__.'/src/template/head.inc.php';
  require_once __DIR__.'/src/template/header.inc.php';
  require_once __DIR__.'/src/template/nav.inc.php';
?>
        <section>
            <!-- sign in -->
            <form action="#" class="sign_in">
                <label for="pseudo">Pseudo ou Email</label>
                <input type="text" name="pseudo" id="pseudo" required>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
            </form>
            <!-- sign out -->
            <!-- Pseudo - Email - password -->
            <form action="#" class="sign_out">
                <label for="pseudo">Pseudo</label>
                <input type="text" name="pseudo" id="pseudo" required>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
            </form>
        </section>
<?php
  require_once __DIR__.'/src/template/footer.inc.php';
?>