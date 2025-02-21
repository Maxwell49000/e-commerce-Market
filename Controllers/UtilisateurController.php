<?php



require 'Controller.php';
require_once '../Models/UtilisateurModel.php';
require_once '../Entities/Utilisateur.php';
require_once '../Models/CommandeModel.php';
require_once '../Entities/Commande.php';

class UtilisateurController extends Controller
{
    // Cette méthode permet l'affichage de la vue de formulaire de connexion:
    public function formConnect()
    {
        $this->render('connection/formConnect');
    }

    // Gestion de la session: Démarre une session PHP si elle n'est pas déjà active (session_start()),
    // ce qui est nécessaire pour stocker les informations de l'utilisateur lors de la connexion:
    public function connect()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $type = $_POST['type'] ?? null;

            // Formulaire "Connexion classique"
            if ($type === 'classique') {
                $nom = htmlspecialchars($_POST['nom'] ?? null);
                $email = htmlspecialchars($_POST['email'] ?? null);
                $password = $_POST['password'] ?? null;

                if (!empty($nom) && !empty($email) && !empty($password)) {
                    $utilisateurModel = new UtilisateurModel();
                    $userArray = $utilisateurModel->find($email);

                    if ($userArray) {
                        $user = new Utilisateur();
                        $user->setId_utilisateur($userArray->id_utilisateur);
                        $user->setEmail($userArray->email);
                        $user->setPassword($userArray->password);
                        $user->setNom($userArray->nom);
                        $user->setStatut($userArray->statut);

                        if ($password === $user->getPassword()) {
                            $_SESSION['nom'] = $user->getNom();
                            $_SESSION['id_utilisateur'] = $user->getId_utilisateur();
                            $_SESSION['statut'] = $user->getStatut();

                            header("Location: index.php?controller=Utilisateur&action=profil");
                            exit;
                        } else {
                            $_SESSION['error'] = "Mot de passe incorrect.";
                        }
                    } else {
                        $_SESSION['error'] = "Aucun compte trouvé avec cet email.";
                    }
                } else {
                    $_SESSION['error'] = "Tous les champs doivent être remplis.";
                }
            }
        }
        header("Location: index.php?controller=Utilisateur&action=formConnect"); // Redirige vers la page de connexion
        exit;
    }



    // Fonction deconnection:
    public function disconnect()
    {
        // Démarrer la session si elle n'est pas déjà démarrée
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Supprimer toutes les variables de session
        $_SESSION = [];


        // Détruire la session
        session_destroy();



        // Supprimer les cookies si nécessaires
        if (isset($_COOKIE['email'])) {
            setcookie("email", "", time() - 3600, "/");
        }
        if (isset($_COOKIE['password'])) {
            setcookie("password", "", time() - 3600, "/");
        }
        if (isset($_COOKIE['nom'])) {
            setcookie("nom", "", time() - 3600, "/");
        }

        // Rediriger vers la page d'accueil ou de connexion
        header("Location: index.php?controller=Utilisateur&action=formConnect");
        exit;
    }


    // // Fonction pour afficher la requête d'affichage:
    // public function displayUtilisateurAction()
    // {
    //     // Instanciation de la class UtilisateurModel pour appeler une de ses méthode juste après:
    //     $utilisateurModel = new UtilisateurModel();

    //     // Création d'un objet "$utilisateurs" pour y stocker le resultat de la requete que l'on appel (findAll):
    //     $utilisateurs = $utilisateurModel->findAll();

    //     $message = isset($_GET['message']) ? $_GET['message'] : "";

    //     // Envoi la vue dans le dossier admin puis dans le fichier displayUtilisateurAction:
    //     $this->render('admin/displayUtilisateurAction', ['utilisateurs' => $utilisateurs, 'message' => $message]);
    // }



    // public function deleteUser()
    // {


    //     // Définition et test de la variable $id contenant le GET de ID:
    //     $id = isset($_GET['id']) ? $_GET['id'] : '';

    //     // Instanciation de la class Utilisateur et settage de l'ID:
    //     $utilisateur = new Utilisateur();
    //     $utilisateur->setId_utilisateur($id);

    //     // Instanciation de la class UtilisateurModel et appel de la méthode "delete" (contenant uniquement la requete DELETE):
    //     $deletemodel = new UtilisateurModel();
    //     $success = $deletemodel->delete($utilisateur);
    //     // var_dump($success);
    //     // die;
    //     $message = $success ? "Utilisateur bien suprimée." : "Suppression non effectuée.";

    //     // Redirection:
    //     header('location:index.php?controller=Utilisateur&action=displayUtilisateurAction&message=' . urlencode($message));
    // }

    public function createUtilisateurAction()
    {
        // Instanciation de la class CategorieModelModel et appel de la méthode "findAll" (pour récuperer les catégories liées aux évènements):
        $categories = new UtilisateurModel();
        $categories = $categories->findAll();

        // Envoi la vue dans le dossier Admin puis dans le fichier createProgrammationAction:
        $this->render('admin/createUserAction', ['categories' => $categories]);
    }


    public function add()
    {
        // Récuperation des valeurs POST du formulaire d'ajout des évènements et stockage dans des variables:
        $nom = $_POST["nom"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $statut = $_POST["statut"];

        // var_dump($_POST);
        // die;

        // Test des informations récupérés via le POST:
        if (
            isset($nom) && isset($password) && isset($email) && isset($statut)
            && !empty($nom) && !empty($password) && !empty($email) && !empty($statut)

        ) {
            // Instanciation de la class Programmation et SET de ses attributs:
            $utilisateur = new Utilisateur();
            $utilisateur->setNom($nom);
            $utilisateur->setPassword($password);
            $utilisateur->setEmail($email);
            $utilisateur->setStatut($statut);

            // var_dump($programmation);


            // Instanciation de la class ProgrammationModel et appel de la méthode "create" (contenant uniquement la requete INSERT):
            $utilisateurModel = new UtilisateurModel();
            $success = $utilisateurModel->create($utilisateur);
            $message = $success ? "Utilisateur bien ajouté." : "Création non effectuée.";
            // Appel de findAll pour récupérer l'ensemble des événements après l'ajout, cela garantit que la vue affichera la liste à jour de tous les événements.
            $utilisateurs = $utilisateurModel->findAll();
            $this->render('admin/createUserAction', ['message' => $message, 'utilisateurs' => $utilisateurs]);
        }
    }
    public function inscription()
    {
        // Récupération des valeurs POST avec vérification de l'existence des clés
        $nom = $_POST["nom"] ?? null;
        $password = $_POST["password"] ?? null;
        $email = $_POST["email"] ?? null;
        $statut = $_POST["statut"] ?? null;

        // Vérification des informations récupérées via POST
        if (
            !empty($nom) &&
            !empty($password) &&
            !empty($email) &&
            !empty($statut)
        ) {
            // Instanciation de la classe Utilisateur et configuration des attributs
            $utilisateur = new Utilisateur();
            $utilisateur->setNom($nom);
            $utilisateur->setPassword($password);
            $utilisateur->setEmail($email);
            $utilisateur->setStatut($statut);

            // Instanciation de la classe UtilisateurModel et appel de la méthode "create"
            $utilisateurModel = new UtilisateurModel();
            $success = $utilisateurModel->create($utilisateur);

            // Message de retour
            $message = $success ? "Inscription effectuée." : "Inscription non effectuée.";

            // Récupération de tous les utilisateurs pour affichage
            $utilisateurs = $utilisateurModel->findAll();

            // Appel de la vue
            $this->render('connection/formConnect', [
                'message' => $message,
                'utilisateurs' => $utilisateurs
            ]);
        } else {
            // Si les champs ne sont pas valides, retour avec un message d'erreur
            $message = "Tous les champs sont requis.";
            $this->render('connection/inscription', ['message' => $message]);
        }
    }

    public function profil()
    {

        if (!isset($_SESSION['id_utilisateur'])) {
            header('Location: index.php?controller=Utilisateur&action=formConnect');
            exit;
        }

        // Récupérer les infos de l'utilisateur connecté
        $utilisateurModel = new UtilisateurModel();
        $utilisateur = $utilisateurModel->getUtilisateurById($_SESSION['id_utilisateur']);

        // Message de retour
        $message = $utilisateur ? "Connexion effectuée, bienvenue sur votre profil! :)" : "Connexion non effectuée.";

        // Récupérer les commandes de l'utilisateur
        $commandeModel = new CommandeModel();
        $commandes = $commandeModel->getCommandesByUser($_SESSION['id_utilisateur']);

        $this->render('utilisateur/profil', ['message' => $message, 'utilisateur' => $utilisateur, 'commandes' => $commandes]);
    }
}
