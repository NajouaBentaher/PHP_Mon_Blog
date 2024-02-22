<?php

require 'Controleur/Controleur.php';
require 'Controleur/ControleurBillet.php';
require 'Controleur/ControleurCommentair.php';

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'billet') {
            if (isset($_GET['id'])) {
                $idBillet = intval($_GET['id']);
                if ($idBillet != 0) {
                    billet($idBillet);
                    countComment($idBillet);
                }
                else
                    throw new Exception("Identifiant de billet non valide");
            }
            else
                throw new Exception("Identifiant de billet non défini");

        }else if ($_GET['action'] == 'commenter'){
            if (isset($_GET['id'])) {
                $idBillet = $_POST['id'];
                $auteur   = $_POST['auteur'];
                $contenu  = $_POST['contenu'];

                if ($idBillet != 0) {
                    commenter($auteur,$contenu,$idBillet);
                }
                else
                    throw new Exception("Identifiant de billet non valide");
            }
            else
                throw new Exception("Identifiant de billet non défini");
        }
        
        else
            throw new Exception("Action non valide");
    }
    else {  // aucune action définie : affichage de l'accueil
        accueil();
    }
}
catch (Exception $e) {
    erreur($e->getMessage());
}