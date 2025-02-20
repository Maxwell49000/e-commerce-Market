<?php

require 'Controller.php';



class ProduitController extends Controller
{
    private $apiBaseUrl = "http://localhost:3000/produit/"; // Remplace par ton URL API

    public function getProducts()
    {
        $url = $this->apiBaseUrl;
        $response = file_get_contents($url);
        $products = json_decode($response, true);

        $this->render('produit/displayProduitAction', ['products' => $products]);
    }

    public function show($id)
    {
        $json = file_get_contents($this->apiBaseUrl . $id);
        $produit = json_decode($json, true);

        if (!$produit) {
            die("Produit non trouvé.");
        }

        $this->render("produit/produit", ['produit' => $produit]); // Charge la vue correspondante
    }
}
