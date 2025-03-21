<?php

require_once 'Controller.php';




class HomeController extends Controller
{
    private $apiBaseUrl = "http://localhost:3000/produit/";
    // private $apiBaseUrl = "https://7c77-2001-861-5381-9d20-c3e-967a-bc3b-6dcb.ngrok-free.app";
    // Affiche la vue de l'accueil:
    public function homeAction()
    {
        // Récupération des produits depuis l'API
        $response = file_get_contents($this->apiBaseUrl);
        $products = json_decode($response, true);

        $this->render('home/homeAction', ['products' => $products]);
    }


    public function panierView()
    {
        // Affiche la vue du panier:
        $this->render('panier/panier');
    }
}
