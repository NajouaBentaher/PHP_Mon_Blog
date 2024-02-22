<?php
    require_once '../Modele/Auteur.php';
    session_start();

    class ControleurAuteur {
        private $auteur;

        public function __construct() {
            $this->auteur = new Auteur();
        }

        #### Méthode pour gérer le processus de connexion
        public function login($username, $password) {
            if(empty($username) || empty($password)) {
                $this->redirectWithError("Vérifiez que vous avez saisi vos données.");
            }

            $username = $this->validate($username);
            $password = $this->validate($password);

            $auteur = $this->auteur->getAuteur($username, $password);

            if ($auteur) {
                $this->setUserSession($auteur);
                $this->redirectToHome("Logged in successfully!");
            } else {
                $this->redirectWithError("Les données que vous avez saisi sont incorrect.");
            }
        }

        ### Méthode privée pour configurer la session de l'utilisateur
        private function setUserSession($auteur) {
            $_SESSION['username'] = $auteur['username'];
            $_SESSION['password'] = $auteur['password'];
            $_SESSION['nom'] = $auteur['nom'];
            $_SESSION['id'] = $auteur['id'];
        }

        private function validate($data) {
            return htmlspecialchars(trim($data));
        }

        ### Méthode privée pour rediriger vers la page de connexion avec un message d'erreur
        private function redirectWithError($error) {
            header("Location: ../login.php?error=$error");
            exit();
        }

        ### Méthode privée pour rediriger vers la page d'accueil avec un message de succès
        private function redirectToHome($message) {
            var_dump( $_SESSION['username']);
            header("Location: ../index.php?message=$message");
            exit();
        }
    }

    ####### Vérifie si la méthode HTTP utilisée est POST
    $controleur = new ControleurAuteur();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['uname'] ?? "";
        $password = $_POST['password'] ?? "";

        $controleur->login($username, $password);
    }
?>
