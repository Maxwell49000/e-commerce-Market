<?php

require 'Controller.php';
require_once '../Models/AvisModel.php';
require_once '../Entities/Avis.php';

class AvisController extends Controller
{
    private $avisModel;

    public function __construct()
    {
        $this->avisModel = new AvisModel();
    }

    public function getAvis($id_produit)
    {
        return $this->avisModel->getAvisByProduit($id_produit);
    }
}

    // public function displayAvisAction()
    // {
    //     // Instanciation de la class AvisModel pour appeler une de ses méthode juste après:
    //     $avisModel = new AvisModel();

    //     // Création d'un objet "$avis" pour y stocker le resultat de la requete que l'on appel (findAll):
    //     $avis = $avisModel->findAll();

    //     $message = isset($_GET['message']) ? $_GET['message'] : "";

    //     // Envoi la vue dans le dossier admin puis dans le fichier displayAvisAction:
    //     $this->render('admin/displayAvisAction', ['avis' => $avis, 'message' => $message]);
    // }

    // public function deleteAvis()
    // {


    //     // Définition et test de la variable $id contenant le GET de ID:
    //     $id = isset($_GET['id']) ? $_GET['id'] : '';

    //     // Instanciation de la class Avis et settage de l'ID:
    //     $avis = new Avis();
    //     $avis->setId_avis($id);

    //     // Instanciation de la class AvisModel et appel de la méthode "delete" (contenant uniquement la requete DELETE):
    //     $deletemodel = new AvisModel();
    //     $success = $deletemodel->delete($avis);
    //     // var_dump($success);
    //     // die;
    //     $message = $success ? "Programmation bien suprimée." : "Suppression non effectuée.";

    //     // Redirection:
    //     header('location:index.php?controller=Avis&action=displayAvisAction&message=' . urlencode($message));
    // }

    // public function ajouterCommentaireAction()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         // Récupération des données du formulaire
    //         $nom = addslashes($_POST['nom']); // Protection minimale avec addslashes
    //         $commentaire = addslashes($_POST['commentaire']);
    //         $id_programation = (int)$_POST['id_programmation'];

    //         // Vérifie si l'utilisateur existe
    //         $avisModel = new AvisModel();
    //         $utilisateur = $avisModel->getUtilisateurByNom($nom);

    //         if ($utilisateur) {
    //             $id_utilisateur = $utilisateur->id_utilisateur;
    //         } else {
    //             // Insère l'utilisateur et récupère son ID
    //             $id_utilisateur = $avisModel->ajouterUtilisateur($nom);
    //         }

    //         // Ajoute le commentaire
    //         $result = $avisModel->ajouterCommentaire($commentaire, $id_utilisateur, $id_programation);

    //         if ($result) {
    //             header("Location: index.php?controller=Programmation&action=show&id=" . $id_programation . "&success=1");
    //             exit;
    //         } else {
    //             header("Location: index.php?controller=Programmation&action=show&id=" . $id_programation . "&error=1");
    //             exit;
    //         }
    //     }
    // }

    // // Fonction pour la barre de recherche évènement:
    // public function find()
    // {
    //     // Vérifie que l'utilisateur a bien envoyé une requête
    //     // "trim" nettoie les espaces blancs en début et en fin de la chaîne de la requête,
    //     //  assurant que seules les données pertinentes sont envoyées pour traitement:
    //     if (!isset($_POST['query']) || empty(trim($_POST['query']))) {
    //         return;
    //     }

    //     $query = htmlspecialchars($_POST['query']); // Nettoie l'entrée utilisateur

    //     // Appel du modèle pour chercher les résultats
    //     $avisModel = new AvisModel();
    //     $results = $avisModel->search($query);

    //     // Envoie les résultats à la vue
    //     $this->render('admin/searchAvis', ['results' => $results]);
    // }
