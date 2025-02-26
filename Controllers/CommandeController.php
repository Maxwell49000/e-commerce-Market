<?php
require_once 'Controller.php';
require_once '../Core/DbConnect.php';
require_once '../models/CommandeModel.php';
require_once '../models/UtilisateurModel.php';
require_once '../Entities/Utilisateur.php';
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class CommandeController
{
    private $commandeModel;
    private $apiBaseUrl = "https://7c77-2001-861-5381-9d20-c3e-967a-bc3b-6dcb.ngrok-free.app/produit/";

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
            }

            $pdo->commit();

            // 3️⃣ Récupérer l'utilisateur pour envoyer l'e-mail
            $utilisateurModel = new UtilisateurModel();
            $utilisateur = $utilisateurModel->getUtilisateurById($id_utilisateur);
            $email = $utilisateur['email'];
            $nom = $utilisateur['nom'];

            // 4️⃣ Envoyer un email de confirmation
            $envoye = $this->envoyerEmailConfirmation($email, $nom, $id_commande);

            // 5️⃣ Vider le panier et rediriger
            unset($_SESSION['panier']);
            $_SESSION['message'] = "Votre commande a été validée avec succès !";

            if ($envoye !== true) {
                $_SESSION['message'] .= " (Mais l'email n'a pas pu être envoyé : $envoye)";
            }

            header("Location: index.php?controller=Utilisateur&action=profil");
            exit;
        } catch (Exception $e) {
            $pdo->rollBack();
            $_SESSION['message'] = "Erreur lors de la commande : " . $e->getMessage();
            header("Location: index.php?controller=Panier&action=panierView");
            exit;
        }
    }

    // Fonction pour envoyer l'e-mail
    public function envoyerEmailConfirmation($destinataire, $nomClient, $idCommande)
    {
        $mail = new PHPMailer(true);

        try {
            // Paramètres du serveur SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';   // Serveur SMTP Gmail
            $mail->Port = 587;                // Port de Gmail pour TLS
            $mail->SMTPAuth = true;           // Authentification requise
            $mail->Username = 'ton-email@gmail.com';  // Ton adresse email
            $mail->Password = 'ton-mot-de-passe';    // Ton mot de passe ou un mot de passe d'application
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Sécurisation TLS

            // Test local avec MailHog:
            // $mail->isSMTP();
            // $mail->Host = 'localhost';
            // $mail->Port = 1025; // Port par défaut de MailHog
            // $mail->SMTPAuth = false; // Pas d'authentification requise en local

            // Destinataire
            $mail->setFrom('ton-email@gmail.com', 'Nom du site');
            $mail->addAddress($destinataire, $nomClient);

            // Contenu du mail
            $mail->isHTML(true);
            $mail->Subject = 'Confirmation de votre commande';
            $mail->Body    = "Bonjour <b>$nomClient</b>,<br><br> 
                              Merci pour votre commande. Votre numéro de commande est <b>$idCommande</b>.<br><br>
                              À bientôt !";

            $mail->send();
            return true; // Succès
        } catch (Exception $e) {
            return "Erreur lors de l'envoi de l'email : {$mail->ErrorInfo}";
        }
    }
}
