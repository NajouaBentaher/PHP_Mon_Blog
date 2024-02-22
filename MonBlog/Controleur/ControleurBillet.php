<?php

    require 'Modele/Billet.php';    

    // Affiche la liste de tous les billets du blog
    function accueil() {
        $billets = getBillets();
        require 'Vue/vueAccueil.php';
    }

    function countComment($idBillet){
        $countcommentaires = countCommentaires($idBillet);
        require 'Vue/vueAccueil.php';
    }

    // Affiche les détails sur un billet
    function billet($idBillet) {
        $billet = getBillet($idBillet);
        $commentaires = getCommentaires($idBillet);

        require 'Vue/vueBillet.php';
    }
    
    // Ajoute un commentaire à un billet
    function commenter($auteur, $contenu, $idBillet) {
        // Sauvegarde du commentaire
        $commentaire = ajouterCommentaire($auteur, $contenu, $idBillet);
        // Actualisation de l'affichage du billet
        require 'Vue/vueBillet.php';
    }
    
?>
