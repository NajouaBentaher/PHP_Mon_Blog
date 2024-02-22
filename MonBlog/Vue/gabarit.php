<?php 
    //session_start();
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_SESSION['password']) && isset($_SESSION['username'])){
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="Contenu/accueil.css" />
        <title><?= $titre ?></title>
    </head>
    <body>
        <div id="global">
            <header>
                <button><a href="logout.php" class="nav-link"> <i class="fa fa-sign-out"></i> Exit</a></button> 

                <a href="index.php" class="nav-link"><h1 id="titreBlog">Salut <?php echo ucfirst($_SESSION['nom']); ?>, Bienvenue sur Mon Blog</h1></a>
                <p>Je vous souhaite la bienvenue sur ce modeste blog.</p>
            </header>
            <div id="contenu">
                <?= $contenu ?>
            </div> <!-- #contenu -->
            <footer id="piedBlog">
                Blog réalisé avec PHP, HTML5 et CSS.
            </footer>
        </div> <!-- #global -->
    </body>
</html>
<?php
   }else{
        header("Location: login.php");
        exit();
    }
?>