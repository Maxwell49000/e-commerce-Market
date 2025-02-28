<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'Controller.php';
require_once '../Models/AvisModel.php';
require_once '../Entities/Avis.php';

class AvisController extends Controller
{
    private $apiBaseUrl = "http://localhost:3000/produit/"; // URL de ton API produits
    // private $apiBaseUrl = "https://7c77-2001-861-5381-9d20-c3e-967a-bc3b-6dcb.ngrok-free.app"; // URL de ton API produits
    private $avisModel;

    public function __construct()
    {
        $this->avisModel = new AvisModel();
    }

    public function getAvis($id_produit)
    {
        return $this->avisModel->getAvisByProduit($id_produit);
    }

    public function formAvis($id_produit)
    {
        // Récupérer les infos du produit via l'API
        $json = file_get_contents($this->apiBaseUrl . $id_produit);
        $produit = json_decode($json, true);

        if (!$produit) {
            die("Produit non trouvé.");
        }

        // Passer les infos du produit à la vue
        $this->render('avis/FormAvis', ['produit' => $produit]);
    }

    // public function add()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         // Récupérer les données du formulaire
    //         $note = (int)$_POST['note'];
    //         $commentaire = htmlspecialchars($_POST['commentaire']);
    //         $id_produit = (int)$_POST['id_produit'];
    //         $id_utilisateur = (int)$_SESSION['id_utilisateur']; // Assurer que l'utilisateur est connecté

    //         // Validation de la note et du commentaire
    //         if ($note >= 1 && $note <= 5 && !empty($commentaire) && $id_produit > 0 && $id_utilisateur > 0) {
    //             // Ajouter l'avis à la base de données via le modèle
    //             $this->avisModel->addAvis($note, $commentaire, $id_produit, $id_utilisateur);

    //             // Rediriger après ajout
    //             header("Location: index.php?controller=Produit&action=show&id=" . $id_produit);
    //             exit;
    //         } else {
    //             // Message d'erreur si la validation échoue
    //             echo "Veuillez remplir correctement le formulaire.";
    //         }
    //     }
    // }

    public function ajouterAvis()
    {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['id_utilisateur'])) {
            echo json_encode(["success" => false, "error" => "Vous devez être connecté pour ajouter un avis."]);
            exit;
        }

        // Récupérer les données
        $note = isset($_POST['note']) ? (int)$_POST['note'] : 0;
        $commentaire = isset($_POST['commentaire']) ? $_POST['commentaire'] : '';
        $id_produit = isset($_POST['id_produit']) ? (int)$_POST['id_produit'] : 0;
        $id_utilisateur = (int)$_SESSION['id_utilisateur'];

        // Validation simple
        if ($note < 1 || $note > 5 || empty($commentaire) || $id_produit <= 0) {
            echo json_encode(["success" => false, "error" => "Données invalides"]);
            exit;
        }

        // Sécuriser le commentaire
        $commentaire = htmlspecialchars($commentaire);

        // Ajouter l'avis
        $success = $this->avisModel->ajouterAvis($id_produit, $id_utilisateur, $note, $commentaire);


        // Répondre
        if ($success) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "Erreur lors de l'ajout de l'avis"]);
        }
        exit;
    }
}
