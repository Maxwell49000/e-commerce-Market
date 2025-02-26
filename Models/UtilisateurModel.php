<?php
// Inclusion du fichier de connexion à la base de données:
require_once '../Core/DbConnect.php';

// Définition de la classe UtilisateurModel qui hérite de DbConnect:
class UtilisateurModel extends DbConnect
{

    // Recherche un utilisateur par son adresse email:     
    //   @param string $email - L'email de l'utilisateur à rechercher
    //   @return array|false - Retourne un tableau contenant les données de l'utilisateur ou false si non trouvé     
    public function find($email)
    {
        // Préparation de la requête SQL avec un paramètre nommé ":email":
        $this->request = $this->connection->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        // Liaison du paramètre email:
        $this->request->bindParam(":email", $email);
        // Exécution de la requête:
        $this->request->execute();
        // Récupération du résultat sous forme de tableau associatif:
        $user = $this->request->fetch();
        // Retourne l'utilisateur trouvé ou false si aucun utilisateur n'existe avec cet email
        return $user;
    }


    //   Récupère tous les utilisateurs enregistrés dans la base de données     
    //   @return array - Retourne un tableau contenant tous les utilisateurs     
    public function findAll()
    {
        // Requête SQL pour récupérer tous les utilisateurs
        $this->request = "SELECT * FROM utilisateurs";
        $result = $this->connection->query($this->request);
        // Récupère tous les résultats sous forme de tableau:
        $programmation = $result->fetchAll();

        // Retourne la liste des utilisateurs:
        return $programmation;
    }


    //   Récupère un utilisateur par son ID:      
    //   @param int $id - L'ID de l'utilisateur
    //   @return array|false - Retourne un tableau avec les informations de l'utilisateur ou false si non trouvé     
    public function getUtilisateurById($id)
    {
        $stmt = $this->connection->prepare("SELECT id_utilisateur, nom, email FROM utilisateurs WHERE id_utilisateur = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    //  Crée un nouvel utilisateur dans la base de données:      
    //   @param object $utilisateur - Un objet utilisateur contenant les informations nécessaires
    //   @return int - Retourne le nombre de lignes affectées (1 si succès, 0 sinon)
    public function create($utilisateur)
    {

        // Création de variables pour getter les informations de la table (les faire transiter):
        $nom = $utilisateur->getNom();
        $password = $utilisateur->getPassword();
        $email = $utilisateur->getEmail();
        $statut = $utilisateur->getStatut();



        // Requête pour inserer dans la BDD les valeurs précedement getté:
        $this->request = 'INSERT INTO utilisateurs VALUES (NULL, "' . $nom . '","' . $email . '", "' . $password . '", "' . 0 . '")';

        $success = $this->connection->exec($this->request);
        // Récupération de l'ID du dernier utilisateur inséré:
        $id_utilisateur = $this->connection->lastInsertId();

        // Retourne 1 si l'insertion a réussi, sinon 0:
        return $success;
    }
}
