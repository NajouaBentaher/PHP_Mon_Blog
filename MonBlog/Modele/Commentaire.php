<?php
    require_once 'Modele.php';
    class Commentaire extends Modele {
        // Renvoie la liste des commentaires associés à un billet
        public function getCommentaires($idBillet) {
            $sql = 'select COM_ID as id, COM_DATE as date,'
            . ' COM_AUTEUR as auteur, COM_CONTENU as contenu from T_COMMENTAIRE'
            . ' where BIL_ID=?';
            $commentaires = $this->executerRequete($sql, array($idBillet));
            return $commentaires;
        }
        // Renvoie le nombre de commentaires associés à un billet
        /*public function countCommentaires($idBillet) {
            $sql = 'SELECT COUNT(COM_ID) AS count FROM T_COMMENTAIRE WHERE BIL_ID=?';
            $result = $this->executerRequete($sql, array($idBillet));
            $row = $result->fetch();
            return $row['count'];
        }*/

        public function ajouterCommentaire($auteur, $contenu, $idBillet) {
            $sql = 'insert into T_COMMENTAIRE(COM_DATE, COM_AUTEUR, COM_CONTENU, BIL_ID)'
            . ' values(?, ?, ?, ?)';
            $date = date(DATE_W3C); // Récupère la date courante
            $this->executerRequete($sql, array($date, $auteur, $contenu, $idBillet));
        }
        
    }
?>