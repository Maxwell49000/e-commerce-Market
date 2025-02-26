<?php
// Inclusion du fichier de connexion à la base de données:
require_once '../Core/DbConnect.php';


class PanierModel
{
    // Tableau contenant les articles du panier:
    private $items = [];

    public function __construct()
    {
        // Vérifie si un panier existe déjà en session, sinon l'initialise:
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }
        // Charge le panier existant en session:
        $this->items = $_SESSION['panier'];
    }

    //   Ajoute un article au panier ou met à jour sa quantité si déjà présent:      
    //   @param array $produit - Les informations du produit
    //   @param int $quantite - La quantité à ajouter (par défaut 1)     
    public function ajouterArticle($produit, $quantite = 1)
    {
        // Récupère l'identifiant du produit:
        $id = $produit['id_produit'];
        if (isset($this->items[$id])) {
            // Augmente la quantité:
            $this->items[$id]['quantite'] += $quantite;
        } else {
            // Ajoute le produit avec ses détails dans le panier:
            $this->items[$id] = [
                'id' => $id,
                'nom' => $produit['nom_produit'],
                'prix' => $produit['prix'],
                'quantite' => $quantite,
                'image' => $produit['image'],
                'description' => $produit['description']
            ];
        }
        // Sauvegarde les modifications du panier en session:
        $this->sauvegarder();
    }
    // Supprime un article du panier:    
    //  @param int $id - L'identifiant du produit à supprimer
    public function retirerArticle($id)
    {
        if (isset($this->items[$id])) {
            // Supprime l'article du panier:
            unset($this->items[$id]);
            // Sauvegarde les modifications:
            $this->sauvegarder();
        }
    }

    //   Modifie la quantité d'un article dans le panier :     
    //   @param int $id - L'identifiant du produit
    //   @param int $quantite - La nouvelle quantité     
    public function modifierQuantite($id, $quantite)
    {
        if (isset($this->items[$id])) {
            // Si la quantité est 0 ou négative, on supprime l'article:
            if ($quantite <= 0) {
                $this->retirerArticle($id);
            } else {
                // Met à jour la quantité:
                $this->items[$id]['quantite'] = $quantite;
                // Sauvegarde les modifications:
                $this->sauvegarder();
            }
        }
    }
    //  Récupère le contenu actuel du panier      
    //   @return array - Retourne un tableau contenant tous les articles du panier     
    public function getContenu()
    {
        return $this->items;
    }


    //   Calcule le total du panier (somme des prix * quantités)      
    //   @return float - Le montant total du panier     
    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            // Calcule le total par produit:
            $total += $item['prix'] * $item['quantite'];
        }
        return $total;
    }
    // Vide complètement le panier:
    public function vider()
    {
        // Réinitialise le tableau des articles:
        $this->items = [];
        // Sauvegarde la session avec un panier vide
        $this->sauvegarder();
    }
    // Sauvegarde le panier actuel dans la session:
    private function sauvegarder()
    {
        // Met à jour la session avec les articles du panier:
        $_SESSION['panier'] = $this->items;
    }
}
