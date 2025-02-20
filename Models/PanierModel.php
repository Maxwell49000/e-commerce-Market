<?php

require_once '../Core/DbConnect.php';





class PanierModel extends DbConnect
{
    private $programmationModel;

    public function __construct()
    {
        parent::__construct();



        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }
    }

    public function getArticleDetails($id)
    {
        // Utiliser ProgrammationModel pour récupérer les détails
        return $this->programmationModel->getProgrammationById($id);
    }

    public function ajouter($id, $quantite)
    {
        if (empty($id)) {
            throw new Exception("ID de l'article vide ou invalide.");
        }

        // Récupérer les détails de l'article
        $details = $this->getArticleDetails($id);

        if (!$details) {
            throw new Exception("Impossible de trouver l'article avec l'ID $id.");
        }

        // Ajouter ou mettre à jour l'article dans le panier
        if (isset($_SESSION['panier'][$id])) {
            $_SESSION['panier'][$id]['quantite'] += $quantite;
        } else {
            $_SESSION['panier'][$id] = [
                'id_programmation' => $id, // Enregistrer l'ID de la programmation
                'quantite' => $quantite,
                'nom' => $details->nom,
                'description' => $details->description,
                'prix' => $details->prix,
            ];
        }
    }

    public function supprimer($id)
    {
        if (isset($_SESSION['panier'][$id])) {
            unset($_SESSION['panier'][$id]);
        }
    }

    public function supprimerPanier()
    {
        if (isset($_SESSION['panier'])) {
            unset($_SESSION['panier']);
        }
    }

    public function modifier()
    {
        // Récupération des données du formulaire
        $index = $_POST['index'];
        $quantite = (int)$_POST['quantite'];


        if (isset($_SESSION['panier'][$index])) {
            $_SESSION['panier'][$index]['quantite'] = $quantite;
        }
    }

    public function getPanier()
    {
        return isset($_SESSION['panier']) ? $_SESSION['panier'] : [];
    }
}
