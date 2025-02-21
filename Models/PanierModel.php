<?php

require_once '../Core/DbConnect.php';


class PanierModel
{
    private $items = [];

    public function __construct()
    {
        // Initialiser le panier depuis la session
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }
        $this->items = $_SESSION['panier'];
    }

    public function ajouterArticle($produit, $quantite = 1)
    {
        $id = $produit['id_produit'];
        if (isset($this->items[$id])) {
            $this->items[$id]['quantite'] += $quantite;
        } else {
            $this->items[$id] = [
                'id' => $id,
                'nom' => $produit['nom_produit'],
                'prix' => $produit['prix'],
                'quantite' => $quantite,
                'image' => $produit['image'],
                'description' => $produit['description']
            ];
        }
        $this->sauvegarder();
    }

    public function retirerArticle($id)
    {
        if (isset($this->items[$id])) {
            unset($this->items[$id]);
            $this->sauvegarder();
        }
    }

    public function modifierQuantite($id, $quantite)
    {
        if (isset($this->items[$id])) {
            if ($quantite <= 0) {
                $this->retirerArticle($id);
            } else {
                $this->items[$id]['quantite'] = $quantite;
                $this->sauvegarder();
            }
        }
    }

    public function getContenu()
    {
        return $this->items;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['prix'] * $item['quantite'];
        }
        return $total;
    }

    public function vider()
    {
        $this->items = [];
        $this->sauvegarder();
    }

    private function sauvegarder()
    {
        $_SESSION['panier'] = $this->items;
    }
}
