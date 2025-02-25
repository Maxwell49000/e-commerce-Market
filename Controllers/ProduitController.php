<?php

require 'Controller.php';
require_once '../Models/AvisModel.php';
require_once '../Entities/Avis.php';

class ProduitController extends Controller
{
    private $apiBaseUrl = "http://localhost:3000/produit/";
    private $avisModel; // Déclare une propriété pour le modèle AvisModel

    // Le constructeur initialise le modèle AvisModel
    public function __construct()
    {
        // Initialisation du modèle AvisModel
        $this->avisModel = new AvisModel();
    }

    public function getProducts()
    {
        $url = $this->apiBaseUrl;
        $response = file_get_contents($url);
        $products = json_decode($response, true);

        $this->render('produit/displayProduitAction', ['products' => $products]);
    }

    public function home()
    {
        $url = $this->apiBaseUrl;
        $response = file_get_contents($url);
        $products = json_decode($response, true);

        // Envoyer les produits à la vue d'accueil
        $this->render('home/homeAction', ['products' => $products]);
    }

    public function show($id)
    {
        // Récupération du produit via l'API
        $json = file_get_contents($this->apiBaseUrl . $id);
        $produit = json_decode($json, true);

        // Vérifier si le produit existe
        if (!$produit) {
            die("Produit non trouvé.");
        }

        // Récupérer les avis pour ce produit
        $avis = $this->avisModel->getAvisByProduit($id); // Utilise l'instance de AvisModel


        // Charger la vue avec les données du produit et des avis
        $this->render("produit/produit", [
            'produit' => $produit,
            'avis' => $avis
        ]);
    }

    public function getProductById($id)
    {
        $json = file_get_contents($this->apiBaseUrl . $id);
        return json_decode($json, true);
    }

    public function getProduitFromAPI($id)
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
            // Log la réponse de l'API pour vérifier ce qu'elle renvoie
            error_log("Réponse de l'API pour l'ID $id: " . $response);

            if ($httpCode === 200) {
                $produit = json_decode($response, true);
                error_log("Données du produit reçues de l'API pour l'ID $id:");
                error_log(print_r($produit, true));

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
