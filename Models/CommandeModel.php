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


    // 4️⃣ Récupérer les commandes d'un utilisateur
    public function getCommandesByUser($id_utilisateur)
    {
        $stmt = $this->connection->prepare("
            SELECT c.id_commande, c.date_commande, c.total, c.statut_commande,
                   d.id_detail_commande, d.id_produit, d.quantite, d.prix_unitaire
            FROM commande c
            LEFT JOIN detail_commande d ON c.id_commande = d.id_commande
            WHERE c.id_utilisateur = ?
            ORDER BY c.date_commande DESC
        ");
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
