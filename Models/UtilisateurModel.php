<?php

require_once '../Core/DbConnect.php';

class UtilisateurModel extends DbConnect
{

    public function find($email)
    {

        $this->request = $this->connection->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $this->request->bindParam(":email", $email);
        $this->request->execute();
        $user = $this->request->fetch();
        return $user;
    }

    public function findAll()
    {
        // Requête pour selectionner tous les champs de la table creation:
        $this->request = "SELECT * FROM utilisateurs";
        $result = $this->connection->query($this->request);
        $programmation = $result->fetchAll();

        return $programmation;
    }


    // public function delete($utilisateur)
    // {
    //     // Création d'une variable $id  pour getter l'id (la faire transiter):
    //     $id = $utilisateur->getId_utilisateur();

    //     // Suppression des avis liés avant de supprimer l'utilisateur
    //     $this->request = "DELETE FROM avis WHERE id_utilisateur = :id";
    //     $stmt = $this->connection->prepare($this->request);
    //     $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    //     $stmt->execute();

    //     // Requête supprimant tous les champs de la table utilisateur ou l'id = l'id:
    //     $this->request = "DELETE FROM utilisateurs WHERE id_utilisateur =  $id";

    //     return $this->connection->exec($this->request);
    // }


    public function create($utilisateur)
    {
        // var_dump($categories);
        // Création de variables pour getter les informations de la table (les faire transiter):
        $nom = $utilisateur->getNom();
        $password = $utilisateur->getPassword();
        $email = $utilisateur->getEmail();
        $statut = $utilisateur->getStatut();



        // Requête pour inserer dans la BDD les valeurs précedement getté:
        $this->request = 'INSERT INTO utilisateurs VALUES (NULL, "' . $nom . '","' . $email . '", "' . $password . '", "' . 0 . '")';

        $success = $this->connection->exec($this->request);

        $id_utilisateur = $this->connection->lastInsertId();


        return $success;
    }
}
