<?php

require_once '../Core/DbConnect.php';

class CommandeModel extends DbConnect
{



    //     public function findAll()
    //     {

    //         $this->request = "SELECT 
    //     r.id_reservation,
    //     r.id_utilisateur,
    //     u.nom AS nom_utilisateur,
    //     u.email,
    //     r.id_programmation,
    //     p.nom AS nom_evenement,
    //     r.quantite_reservee,
    //     p.quantite AS quantite_totale_disponible,
    //     p.prix,
    //     p.date_evenement
    // FROM 
    //     reservation r
    // INNER JOIN 
    //     programmation p 
    // ON 
    //     r.id_programmation = p.id_programmation
    // INNER JOIN 
    //     utilisateur u
    // ON 
    //     r.id_utilisateur = u.id_utilisateur;";
    //         $result = $this->connection->query($this->request);
    //         $selection = $result->fetchAll();

    //         return $selection;
    //     }


    //     // Commence une transaction
    //     public function startTransaction()
    //     {
    //         $this->connection->beginTransaction();
    //     }

    //     // Valide la transaction
    //     public function commitTransaction()
    //     {
    //         $this->connection->commit();
    //     }

    //     // Annule la transaction
    //     public function rollbackTransaction()
    //     {
    //         $this->connection->rollBack();
    //     }

    //     // Ajoute une réservation dans la base
    //     public function addReservation($id_programmation, $id_utilisateur, $quantite)
    //     {
    //         // Vérifier qu'il y a suffisamment de places disponibles dans programmation
    //         $query_check = "SELECT quantite FROM programmation WHERE id_programmation = $id_programmation";
    //         $result = $this->connection->query($query_check);
    //         $row = $result->fetch(PDO::FETCH_ASSOC);


    //         if ($row && $row['quantite'] >= $quantite) {

    //             // Insérer dans la table reservation avec la quantité réservée
    //             $query_insert = "INSERT INTO reservation (id_programmation, id_utilisateur, quantite_reservee) VALUES ($id_programmation, $id_utilisateur, $quantite)";
    //             $this->connection->exec($query_insert);

    //             // Mettre à jour la table programmation
    //             $query_update = "UPDATE programmation SET quantite = quantite - $quantite WHERE id_programmation = $id_programmation";
    //             $this->connection->exec($query_update);
    //         } else {
    //             // Gérer le cas où il n'y a pas assez de places disponibles
    //             echo "Pas assez de places disponibles pour cet événement.";
    //         }
    //     }



    //     public function deleteReservation($id_reservation)
    //     {
    //         try {
    //             $this->connection->beginTransaction();

    //             // Récupérer les informations de la réservation
    //             $query_select = "SELECT id_programmation, quantite_reservee FROM reservation WHERE id_reservation = :id_reservation";
    //             $stmt_select = $this->connection->prepare($query_select);
    //             $stmt_select->execute([':id_reservation' => $id_reservation]);
    //             $row = $stmt_select->fetch(PDO::FETCH_ASSOC);

    //             if (!$row) {
    //                 throw new Exception("La réservation n'existe pas.");
    //             }

    //             // Remettre les places disponibles
    //             $query_update = "UPDATE programmation SET quantite = quantite + :quantite_reservee WHERE id_programmation = :id_programmation";
    //             $stmt_update = $this->connection->prepare($query_update);
    //             $stmt_update->execute([
    //                 ':quantite_reservee' => $row['quantite_reservee'],
    //                 ':id_programmation' => $row['id_programmation']
    //             ]);

    //             // Supprimer la réservation
    //             $query_delete = "DELETE FROM reservation WHERE id_reservation = :id_reservation";
    //             $stmt_delete = $this->connection->prepare($query_delete);
    //             $stmt_delete->execute([':id_reservation' => $id_reservation]);

    //             $this->connection->commit();
    //             echo "Réservation supprimée et places remises à jour.";
    //         } catch (Exception $e) {
    //             $this->connection->rollBack();
    //             echo "Erreur : " . $e->getMessage();
    //         }
    //     }
}
