<?php

require_once 'Controller.php';

require_once '../Models/PanierModel.php';

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = []; // Le panier est un tableau associatif [id_produit => quantité]
}


class PanierController extends Controller
{
    private $panier;

    // Initialise le modèle PanierModel, qui sera utilisé pour effectuer les opérations sur le panier, comme l'ajout, la suppression, ou la modification des articles:
    public function __construct()
    {
        // Le modèle PanierModel est instancié et stocké dans la propriété privée $this->panier.
        //  Ce modèle contient les méthodes nécessaires pour manipuler les données du panier, 
        //  comme ajouter un article,supprimer un article, ou modifier la quantité d'un article dans le panier:
        $this->panier = new PanierModel();
    }


    // Affiche la vue du panier, permettant à l'utilisateur de voir les articles actuellement dans son panier,
    //  ainsi que les informations de quantités et de prix:
    public function panierView()
    {
        $this->render('panier/panier');
    }

    public function ajouterArticle()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Supposons que vous ayez une méthode pour récupérer les détails du produit via l'API
            $produit = $this->getProduitFromAPI($id);
            if ($produit) {
                $this->panier->ajouterArticle($produit);
                header('Location: index.php?controller=Panier&action=panierView');
                exit;
            }
        }
        // Gérer l'erreur
        header('Location: index.php?controller=Produit&action=getProducts');
    }

    public function retirerArticle()
    {
        if (isset($_GET['id'])) {
            $this->panier->retirerArticle($_GET['id']);
        }
        header('Location: index.php?controller=Panier&action=panierView');
    }

    public function viderPanier()
    {
        $this->panier->vider();
        header('Location: index.php?controller=Panier&action=panierView');
        exit;
    }

    public function modifierQuantite()
    {
        if (isset($_POST['index']) && isset($_POST['quantite'])) {
            $index = $_POST['index'];
            $quantite = intval($_POST['quantite']);

            // Vérification que l'article existe dans le panier
            if (isset($_SESSION['panier'][$index])) {
                // Vérification que la quantité est positive
                if ($quantite > 0) {
                    $_SESSION['panier'][$index]['quantite'] = $quantite;
                } else {
                    // Si quantité invalide, on met 1 par défaut
                    $_SESSION['panier'][$index]['quantite'] = 1;
                }
            }
        }

        // Redirection vers le panier
        header('Location: index.php?controller=Panier&action=panierView');
        exit;
    }

    public function afficher()
    {
        $contenu = $this->panier->getContenu();
        $total = $this->panier->getTotal();
        // Charger la vue
        require_once 'Views/panier.php';
    }

    private function getProduitFromAPI($id)
    {
        // Remplacez l'URL par l'URL réelle de votre API Node.js
        $apiUrl = "http://localhost:3000/produit/" . $id;  // Ajustez le port si nécessaire

        try {
            // Initialisation de cURL
            $ch = curl_init();

            // Configuration de la requête
            curl_setopt_array($ch, [
                CURLOPT_URL => $apiUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FAILONERROR => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => ["Content-Type: application/json"]
            ]);

            // Exécution de la requête
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if ($httpCode === 200) {
                $produit = json_decode($response, true);
                return $produit; // Votre API renvoie déjà le bon format de données
            }

            // Gestion des erreurs
            if ($httpCode === 404) {
                // Produit non trouvé
                return null;
            }
        } catch (Exception $e) {
            // Log de l'erreur
            error_log("Erreur lors de la récupération du produit : " . $e->getMessage());
            return null;
        } finally {
            if ($ch) {
                curl_close($ch);
            }
        }

        return null;
    }
}
