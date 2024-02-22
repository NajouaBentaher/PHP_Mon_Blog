<?php
    require_once 'Modele.php';
    class Auteur extends Modele {
        // Renvoie les informations sur un billet
        public function getAuteur($username,$password) {
        $sql = 'select aut_id as id, username, password, aut_nom as nom'
        . ' from t_auteur where username=? and password=?';

        $auteur = $this->executerRequete($sql, array($username,$password));
        if ($auteur->rowCount() == 1)
            return $auteur->fetch(); // Accès à la première ligne de résultat
        else
            return false;
        }
    }
?>