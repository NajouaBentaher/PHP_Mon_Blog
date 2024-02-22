<?php
    abstract class Modele {

        // Objet PDO d'accès à la BD
        private $bdd;
        // Exécute une requête SQL éventuellement paramétrée
        protected function executerRequete($sql, $params = null) {
            if ($params == null) {
            $resultat = $this->getBdd()->query($sql); 
            }
            else {
            $resultat = $this->getBdd()->prepare($sql); 
            $resultat->execute($params);
            }
            return $resultat;
        }
        // Renvoie un objet de connexion à la BD en initialisant la connexion au besoin
        private function getBdd() {
            if ($this->bdd == null) {
            // Création de la connexion
            $this->bdd = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8',
            'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            return $this->bdd;
        }
    }
        // Renvoie la liste des billets du blog
        function getBillets() {
            $bdd = getBdd();
            $billets = $bdd->query('select BIL_ID as id, BIL_DATE as date,'
                    . ' BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET'
                    . ' order by BIL_ID desc');
            
            return $billets;
        }

        // Renvoie les informations sur un billet
        function getBillet($idBillet) {
            $bdd = getBdd();
            $billet = $bdd->prepare('select BIL_ID as id, BIL_DATE as date,'
                    . ' BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET'
                    . ' where BIL_ID=?');
            $billet->execute(array($idBillet));
            if ($billet->rowCount() == 1)
                return $billet->fetch();  // Accès à la première ligne de résultat
            else
                throw new Exception("Aucun billet ne correspond à l'identifiant '$idBillet'");
        }

        // Renvoie la liste des commentaires associés à un billet
        function getCommentaires($idBillet) {
            $bdd = getBdd();
            $commentaires = $bdd->prepare('select COM_ID as id, COM_DATE as date,'
                    . ' COM_AUTEUR as auteur, COM_CONTENU as contenu from T_COMMENTAIRE'
                    . ' where BIL_ID=?');
            $commentaires->execute(array($idBillet));
            return $commentaires;
        }

        // Renvoie le nombre de commentaires associés à un billet 
        function countCommentaires($idBillet) {
            $bdd = getBdd();

            $result = $bdd->query("SELECT COUNT(COM_ID) AS count FROM T_COMMENTAIRE WHERE BIL_ID='$idBillet'");
            //$result = $sql->execute(array($idBillet));
            //$row = $result->fetch();
            //return $row['count'];
            return $result;
        }
        
        //l'ajout des commentaire
        /*function ajouterCommentaire($auteur, $contenu, $idBillet) {
            $date = date(DATE_W3C);
            $bdd = getBdd();

            $result = $bdd->query('insert into T_COMMENTAIRE(COM_DATE, COM_AUTEUR, COM_CONTENU, BIL_ID)'
            . ' values(?, ?, ?, ?)');
             // Récupère la date courante
            $result->execute(array($date, $auteur, $contenu, $idBillet));
            return $result->fetch();
        }*/
        function ajouterCommentaire($auteur, $contenu, $idBillet) {
            $date = date('Y-m-d H:i:s'); // Use the correct date format for your database
            $bdd = getBdd();
        
            // Prepare the SQL statement
            $stmt = $bdd->prepare('INSERT INTO T_COMMENTAIRE (COM_DATE, COM_AUTEUR, COM_CONTENU, BIL_ID) VALUES (?, ?, ?, ?)');
            
            // Execute the statement with the provided parameters
            $stmt->execute([$date, $auteur, $contenu, $idBillet]);
            
            // No need to fetch anything for an insert operation
            // Return any relevant information if needed
        }

        // Effectue la connexion à la BDD
        // Instancie et renvoie l'objet PDO associé
        function getBdd() {
            $bdd = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            return $bdd;
        }
    
?>