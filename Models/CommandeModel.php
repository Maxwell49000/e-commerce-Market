<?php

require_once '../Core/DbConnect.php';

class CommandeModel extends DbConnect
{



    // 1️⃣ Créer une commande
    public function creerCommande($id_utilisateur, $total)
    {
        $stmt = $this->connection->prepare("INSERT INTO commande (id_utilisateur, total) VALUES (?, ?)");
        $stmt->execute([$id_utilisateur, $total]);
        return $this->connection->lastInsertId(); // Retourne l'ID de la commande créée
    }

    // 2️⃣ Ajouter les détails de la commande
    public function ajouterDetailsCommande($id_commande, $id_produit, $quantite, $prix_unitaire)
    {
        $stmt = $this->connection->prepare("INSERT INTO detail_commande (id_commande, id_produit, quantite, prix_unitaire) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$id_commande, $id_produit, $quantite, $prix_unitaire]);
    }

    // // 3️⃣ Mettre à jour le stock des produits
    // public function mettreAJourStock($id_produit, $quantite)
    // {
    //     $stmt = $this->connection->prepare("UPDATE produits SET quantite = quantite - ? WHERE id_produit = ?");
    //     return $stmt->execute([$quantite, $id_produit]);
    // }

    // 4️⃣ Récupérer les commandes d'un utilisateur
    public function getCommandesByUser($id_utilisateur)
    {
        $stmt = $this->connection->prepare("SELECT * FROM commande WHERE id_utilisateur = ? ORDER BY date_commande DESC");
        $stmt->execute([$id_utilisateur]);
        return $stmt->fetchAll();
    }
    // 5️⃣ Modifier le statut d'une commande (Admin)
    public function modifierStatutCommande($id_commande, $statut)
    {
        $stmt = $this->connection->prepare("UPDATE commande SET statut_commande = ? WHERE id_commande = ?");
        return $stmt->execute([$statut, $id_commande]);
    }
}
