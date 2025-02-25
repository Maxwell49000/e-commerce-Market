<?php

require_once '../Core/DbConnect.php';


class AvisModel extends DbConnect
{

    public function getAvisByProduit($id_produit)
    {
        // Requête SQL pour récupérer les avis du produit
        $sql = "SELECT avis.*, utilisateurs.nom as auteur 
                FROM avis 
                JOIN utilisateurs ON avis.id_utilisateur = utilisateurs.id_utilisateur 
                WHERE avis.id_produit = ?";

        // Préparation de la requête
        $stmt = $this->connection->prepare($sql);

        // Exécution de la requête avec le paramètre id_produit
        $stmt->execute([$id_produit]);

        // Récupérer et retourner tous les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addAvis($note, $commentaire, $id_produit, $id_utilisateur)
    {


        // Préparer la requête d'insertion
        $query = "INSERT INTO avis (id_utilisateur, id_produit, note, commentaire) VALUES (:id_utilisateur, :id_produit, :note, :commentaire)";
        $stmt = $this->connection->prepare($query);

        // Lier les paramètres
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $stmt->bindParam(':id_produit', $id_produit, PDO::PARAM_INT);
        $stmt->bindParam(':note', $note, PDO::PARAM_INT);
        $stmt->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);

        // Exécuter la requête
        $stmt->execute();
    }

    public function ajouterAvis($id_produit, $id_utilisateur, $note, $commentaire)
    {
        $sql = "INSERT INTO avis (id_utilisateur, id_produit, note, commentaire) VALUES (:id_utilisateur, :id_produit, :note, :commentaire)";
        $stmt = $this->connection->prepare($sql);

        try {
            if ($stmt->execute([
                "id_utilisateur" => $id_utilisateur,
                "id_produit" => $id_produit,
                "note" => $note,
                "commentaire" => $commentaire
            ])) {
                return true;
            } else {
                // Si la requête échoue, afficher l'erreur SQL
                $errorInfo = $stmt->errorInfo();
                error_log("Erreur SQL : " . implode(", ", $errorInfo));
                return false;
            }
        } catch (PDOException $e) {
            error_log("Erreur d'exécution de la requête : " . $e->getMessage());
            return false;
        }
    }
}
