<?php

require 'Controller.php';
require_once '../Models/AvisModel.php';
require_once '../Entities/Avis.php';

class ProduitController extends Controller
{
    private $apiBaseUrl = "http://localhost:3000/produit/"; // Remplace par ton URL API
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
}
