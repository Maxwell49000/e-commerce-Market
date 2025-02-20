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

    // public function select($avis)
    // {
    //     // Création d'une variable $id  pour getter l'id (la faire transiter):
    //     $id = $avis->getId_avis();

    //     // Requête selectionnant tous les champs de la table creation ou l'id = l'id:
    //     $this->request = "SELECT avis.id_avis, avis.commentaire, avis.date_commentaire,utilisateur.nom FROM avis
    //     JOIN programmation ON avis.id_programmation = programmation.id_programmation
    //     JOIN utilisateur ON avis.id_utilisateur = utilisateur.id_utilisateur WHERE programmation.id_programmation =  $id";
    //     $result = $this->connection->query($this->request);
    //     $selection = $result->fetchAll();

    //     return $selection;
    // }

    // public function findAll()
    // {
    //     // Requête pour selectionner tous les champs de la table avis:
    //     $this->request = "SELECT avis.id_avis, avis.commentaire, avis.date_commentaire,utilisateur.nom, programmation.nom AS nom_programmation FROM avis
    //      JOIN programmation ON avis.id_programmation = programmation.id_programmation
    //      JOIN utilisateur ON avis.id_utilisateur = utilisateur.id_utilisateur";
    //     $result = $this->connection->query($this->request);
    //     $programmation = $result->fetchAll();

    //     return $programmation;
    // }

    // public function delete($avis)
    // {
    //     // Création d'une variable $id  pour getter l'id (la faire transiter):
    //     $id = $avis->getId_avis();

    //     // Requête supprimant tous les champs de la table creation ou l'id = l'id:
    //     $this->request = "DELETE FROM avis WHERE id_avis =  $id";

    //     return $this->connection->exec($this->request);
    // }


    // public function getUtilisateurByNom($nom)
    // {
    //     $this->request  = "SELECT id_utilisateur FROM utilisateur WHERE nom = '" . $nom . "'";
    //     $success = $this->connection->query($this->request);
    //     return $success->fetch();
    // }

    // // Insère un nouvel utilisateur
    // public function ajouterUtilisateur($nom)
    // {
    //     $this->request = "INSERT INTO utilisateur (nom, password, email, statut) VALUES ('" . $nom . "', NULL, NULL, 0)";
    //     $success = $this->connection->exec($this->request);
    //     return $this->connection->lastInsertId();
    // }

    // // Insère un commentaire
    // public function ajouterCommentaire($commentaire, $id_utilisateur, $id_programation)
    // {
    //     $this->request  = "INSERT INTO avis (commentaire, date_commentaire, id_utilisateur, id_programmation) 
    //             VALUES ('" . $commentaire . "', NOW(), " . $id_utilisateur . ", " . $id_programation . ")";
    //     return $success = $this->connection->exec($this->request);
    // }

    // public function search()
    // {
    //     $query = $_POST['query'];
    //     // var_dump($query);
    //     // die;

    //     $this->request = '
    //     SELECT 
    //         avis.*, 
    //         utilisateur.nom AS utilisateur_nom, 
    //         programmation.nom AS programmation_nom
    //     FROM 
    //         avis
    //     LEFT JOIN 
    //         utilisateur ON avis.id_utilisateur = utilisateur.id_utilisateur
    //     LEFT JOIN 
    //         programmation ON avis.id_programmation = programmation.id_programmation
    //     WHERE 
    //         avis.commentaire LIKE "%' . $query . '%"
    //         OR avis.date_commentaire LIKE "%' . $query . '%"
    //         OR utilisateur.nom LIKE "%' . $query . '%"
    //         OR programmation.nom LIKE "%' . $query . '%"
    // ';
    //     $resultat = $this->connection->query($this->request);
    //     $results = $resultat->fetchAll();

    //     return $results;
    // }
}
