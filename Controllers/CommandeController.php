<?php
require 'Controller.php';
require_once '../Core/DbConnect.php';
require_once '../models/CommandeModel.php';
require_once '../models/UtilisateurModel.php'; // Si besoin
require_once '../Entities/Utilisateur.php';
require_once 'controllers/ProduitController.php'; // Ajuste le chemin si nécessaire

class CommandeController
{
    private $commandeModel;

    public function __construct()
    {
        $this->commandeModel = new CommandeModel();
    }

    // 1️⃣ Valider une commande
    public function validerCommande()
    {
        if (!isset($_SESSION['id_utilisateur'])) {
            header("Location: index.php?controller=Panier&action=panierView");
            exit;
        }

        $id_utilisateur = $_SESSION['id_utilisateur'];

        // Vérifier si le panier est vide
        if (empty($_SESSION['panier'])) {
            $_SESSION['message'] = "Votre panier est vide.";
            header("Location: index.php?controller=Panier&action=panierView");
            exit;
        }

        // Calcul du total
        $total = 0;
        foreach ($_SESSION['panier'] as $id_produit => $details) {
            $total += $details['prix'] * $details['quantite'];
        }

        try {
            $db = new Database();
            $pdo = $db->getPDO();
            $pdo->beginTransaction();

            // 1️⃣ Créer la commande
            $id_commande = $this->commandeModel->creerCommande($id_utilisateur, $total);

            // 2️⃣ Ajouter les produits à la commande
            foreach ($_SESSION['panier'] as $id_produit => $details) {
                $this->commandeModel->ajouterDetailsCommande($id_commande, $id_produit, $details['quantite'], $details['prix']);

                // // 3️⃣ Mettre à jour les stocks
                // $this->commandeModel->mettreAJourStock($id_produit, $details['quantite']);
            }

            $pdo->commit();

            // // 4️⃣ Envoyer un email de confirmation
            // $this->envoyerEmailConfirmation($id_utilisateur, $id_commande);

            // 5️⃣ Vider le panier et rediriger
            unset($_SESSION['panier']);
            $_SESSION['message'] = "Votre commande a été validée avec succès !";
            header("Location: index.php?controller=Utilisateur&action=profil");
            exit;
        } catch (Exception $e) {
            $pdo->rollBack();
            $_SESSION['message'] = "Erreur lors de la commande : " . $e->getMessage();
            header("Location: index.php?controller=Panier&action=panierView");
            exit;
        }
    }

    public function afficherCommandesUtilisateur()
    {
        if (!isset($_SESSION['id_utilisateur'])) {
            header("Location: login.php");
            exit;
        }

        $id_utilisateur = $_SESSION['id_utilisateur'];
        $commandes = $this->commandeModel->getCommandesByUser($id_utilisateur);

        $produitController = new ProduitController(); // Instancier le contrôleur des produits

        foreach ($commandes as &$commande) {

            if (!empty($commande->id_produit)) { // ✅ Accès en tant qu'objet
                $produitInfo = $produitController->getProductById($commande->id_produit);
                $commande->nom_produit = $produitInfo ? $produitInfo['nom'] : "Produit inconnu"; // ✅ Ajout de la propriété à l'objet
            }
        }

        return $commandes;
    }


    // 3️⃣ Modifier le statut d'une commande (Admin)
    public function modifierStatut()
    {
        if (!isset($_POST['id_commande']) || !isset($_POST['statut'])) {
            $_SESSION['message'] = "Données invalides.";
            header("Location: admin_commandes.php");
            exit;
        }

        $this->commandeModel->modifierStatutCommande($_POST['id_commande'], $_POST['statut']);
        header("Location: admin_commandes.php");
        exit;
    }
}
