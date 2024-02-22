<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Contenu/login.css">
    <title>Se connecter à Mon Blog</title>
</head>
<body>
    <form action="Controleur/ControleurAuteur.php?" method="post">
        <h2>Se connecter</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label>Nom d'utilisateur</label>
        <input type="text" name="uname" placeholder="User Name" autocomplete="username"><br>
        <label>Mot de passe</label>
        <input type="password" name="password" placeholder="Password" autocomplete="current-password"><br>
        
        <button type="submit">Se Connecter</button>
    </form>
</body>
</html>

