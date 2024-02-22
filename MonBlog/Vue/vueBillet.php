<?php $titre = "Mon Blog - " . $billet['titre']; ?>

<?php ob_start(); ?>
<article>
    <header>
        <a href="index.php" class="nav-link">
            <i class="fa fa-window-close" style="color: white; font-size: 120%; margin-left: 98%;" ></i>
        </a>
        <h1 class="titreBillet"><?= $billet['titre'] ?></h1>
        <time><?= $billet['date'] ?></time>
    </header>
    <p><?= $billet['contenu'] ?></p>
</article>
<hr />
<header>
    <h1 id="titreReponses">Réponses à <?= $billet['titre'] ?></h1>
</header>
<?php foreach ($commentaires as $commentaire): ?>
    <p><?= $commentaire['auteur'] ?> dit :</p>
    <p><?= $commentaire['contenu'] ?></p>
<?php endforeach; ?>
<hr />
<form method="post" action="<?= "index.php?action=commenter&id=" . $billet['id'] ?>">
    <input id="auteur" name="auteur" type="text" placeholder="Votre pseudo" required /><br />
    <textarea id="txtCommentaire" name="contenu" rows="4" placeholder="Votre commentaire" required></textarea><br />
    <input type="hidden" name="id" value="<?= $billet['id'] ?>" />
    <input type="submit" value="Commenter" />
</form>
<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>
