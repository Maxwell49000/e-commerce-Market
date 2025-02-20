<?php

require_once 'Controller.php';

require_once '../Models/PanierModel.php';



class PanierController extends Controller
{
    private $panier;

    // Initialise le modèle PanierModel, qui sera utilisé pour effectuer les opérations sur le panier, comme l'ajout, la suppression, ou la modification des articles:
    public function __construct()
    {
        // Le modèle PanierModel est instancié et stocké dans la propriété privée $this->panier.
        //  Ce modèle contient les méthodes nécessaires pour manipuler les données du panier, 
        //  comme ajouter un article,supprimer un article, ou modifier la quantité d'un article dans le panier:
        $this->panier = new PanierModel();
    }


    // Affiche la vue du panier, permettant à l'utilisateur de voir les articles actuellement dans son panier,
    //  ainsi que les informations de quantités et de prix:
    public function panierView()
    {
        $this->render('panier/panier');
    }

    // Ajouter un article au panier en fonction de l'ID et de la quantité fournis via les paramètres GET ($_GET):
    public function ajouterArticle()
    {
        // L'ID et la quantité sont vérifiés pour s'assurer qu'ils existent dans les paramètres GET et les valeurs sont converties en entiers pour éviter les failles:
        if (isset($_GET['id']) && isset($_GET['quantite'])) {
            $id = (int)$_GET['id']; // Convertir l'id en entier pour éviter les failles.
            $quantite = (int)$_GET['quantite']; // Convertir la quantité en entier.

            // La quantité est aussi vérifiée pour être supérieure à zéro:
            if ($quantite > 0) {
                $this->panier->ajouter($id, $quantite);
                // Redirection vers la vue du panier après l'ajout
                header('Location: index.php?controller=Panier&action=panierView');
                exit;
            } else {
                echo "Quantité invalide.";
            }
        } else {
            echo "ID ou quantité manquant.";
        }
    }

    // Supprimer un article du panier à l'aide de l'ID passé via les paramètres GET ($_GET):
    public function supprimerArticle()
    {
        // Récupérer l'ID via $_GET
        $id = $_GET['id'] ?? null;


        // Si un ID valide est fourni, la méthode supprimer du modèle PanierModel est appelée pour supprimer l'article du panier:
        if (!isset($id) || empty($id)) {
            // Si aucun ID n'est fourni, redirigez vers le panier
            header('Location: index.php?controller=Panier&action=panierView');
            exit;
        }

        $PanierModel = new PanierModel();
        $avis = $PanierModel->supprimer($id);


        // Redirection vers la vue panier
        header('Location: index.php?controller=Panier&action=panierView');
        exit;
    }

    // Vider le panier de l'utilisateur, c'est-à-dire supprimer tous les articles du panier:
    public function deletePanier()
    {

        // La méthode supprimerPanier du modèle PanierModel est utilisée pour vider le panier:
        $PanierModel = new PanierModel();
        $panier = $PanierModel->supprimerPanier();
        // Redirection vers la vue panier
        header('Location: index.php?controller=Panier&action=panierView');
        exit;
    }

    // Modifier la quantité d'un article dans le panier en fonction des données reçues:
    public function modifierQuantite()
    {
        // La méthode modifier du modèle PanierModel est appelée pour mettre à jour la quantité d'un article spécifique dans le panier:
        $PanierModel = new PanierModel();
        $panier = $PanierModel->modifier();
        // Redirection vers la vue panier
        header('Location: index.php?controller=Panier&action=panierView');
        exit;
    }

    public function validerCommande()
    {
        if (!isset($_SESSION['id_utilisateur'])) {
            header('Location: index.php?controller=Utilisateur&action=formConnect');
            exit;
        }

        $reservationModel = new ReservationModel();


        $cartItems = $this->panier->getPanier(); // Récupérer le panier


        try {
            $reservationModel->startTransaction();



            foreach ($cartItems as $item) {

                $id_programmation = $item['id_programmation'];
                $quantite = $item['quantite'];
                $id_utilisateur = $_SESSION['id_utilisateur'];


                if (!$programmationModel->checkAvailability($id_programmation, $quantite)) {
                    throw new Exception("Pas assez de places pour l'événement ID : $id_programmation");
                }

                // $programmationModel->updatePlaces($id_programmation, $quantite);
                $reservationModel->addReservation($id_programmation, $id_utilisateur, $quantite);
            }

            $reservationModel->commitTransaction();
            $this->panier->supprimerPanier();

            header('Location: index.php?controller=Panier&action=confirmation');
            exit;
        } catch (Exception $e) {
            $reservationModel->rollbackTransaction();
            die("Erreur lors de la commande : " . $e->getMessage());
        }
    }
    public function confirmation()
    {
        $this->render('panier/confirmation');
    }
}
