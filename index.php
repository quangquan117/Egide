<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Egide">

  <title>Egide</title>

  <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
  <link rel="manifest" href="favicon/site.webmanifest">
  <link href="https://unpkg.com/@primer/css@^20.2.4/dist/primer.css" rel="stylesheet" />
  <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <header>
        <h1>Egide</h1>
    </header>
    <main>
        <nav>
          <input type="checkbox" id="burger-toggle">
          <label for="burger-toggle" class="burger-icon">&#9776;</label>
          <ul class="burger-menu">
            <li><a href="#">Base</a></li>
            <li><a href="#">Structure</a></li>
            <li><a href="#">Soldat</a></li>
          </ul>
        </nav>
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
    </main>
    <footer>
        <p>&copy; - MIT - 2024</p>
    </footer>
  </body>
</html>